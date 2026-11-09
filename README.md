# ScholarDesk — Student Management System

**Advanced Web Application Development (BUC3131) · Coursework Two · MUBS 2026/2027**

A Laravel 12 web application where the **Administrator (Registrar)** manages students, lecturers, programmes, courses, registrations and user access; **Lecturers** see their assigned courses, the students registered for them and enter marks; and **Students** see available courses, register for them and view their own registrations, timetable and results.

| Built with | Used for |
| --- | --- |
| Laravel 12 | Framework (migrations, Eloquent, controllers, routes, Blade, validation) |
| Laravel Jetstream 5 (Livewire stack) | Authentication — login, register, password reset, profile, 2FA |
| spatie/laravel-permission 6 | Roles and permissions |
| Tailwind CSS + Lucide icons (Vite) | The ScholarDesk design from the HTML prototype |
| MySQL (or SQLite) | Relational database |

---

## 1. Installation

Requirements: **PHP 8.2+**, **Composer**, **MySQL** (XAMPP/WAMP/Laragon) and optionally **Node.js 18+**.

```bash
# 1. Get the code
git clone https://github.com/<your-group>/student-management-system.git
cd student-management-system

# 2. Install PHP packages (creates the vendor folder)
composer install

# 3. Environment file + app key
cp .env.example .env          # Windows: copy .env.example .env
php artisan key:generate
```

### Database setup

**MySQL (default):**

1. Start MySQL in XAMPP and open phpMyAdmin.
2. Create an empty database called `student_management_system`.
3. Check the `DB_*` lines in `.env` (default user `root`, empty password).

**SQLite (no server):** in `.env` set `DB_CONNECTION=sqlite`, remove the other `DB_*` lines, and create an empty file `database/database.sqlite`.

Then run the migrations and seeders:

```bash
php artisan migrate --seed
# start again from scratch any time:
php artisan migrate:fresh --seed
```

### Run it

```bash
php artisan serve
```

Open **http://127.0.0.1:8000**.

> The compiled CSS/JS is already in `public/build`, so Node.js is not needed to run the app. If you change any Blade classes or `resources/css` / `resources/js`, rebuild it with `npm install` then `npm run build` (or `npm run dev` while you work).

### Run the tests

```bash
php artisan test
```

There are 43 tests (plus 3 Jetstream tests that skip because email verification is off). They cover the relationships, seeders, roles, route protection, CRUD, duplicate-registration prevention, approvals and marks.

---

## 2. User roles and sample login credentials

All sample accounts use the password **`12345678`**. Each user lands on their own dashboard after signing in.

| Role | Email | What they can do |
| --- | --- | --- |
| **Administrator (Registrar)** | `2400725284@mubs.ac.ug` | Manage students, lecturers, programmes, courses and registrations; approve or reject online registrations; change user roles and access; view reports |
| **Lecturer** | `moses.kato@mubs.ac.ug` | View assigned courses (BBC3101, BBC3111), class lists of registered students, enter marks |
| Lecturer | `ruth.atim@mubs.ac.ug`, `paul.wasswa@mubs.ac.ug`, `esther.namubiru@mubs.ac.ug`, `ivan.mugisha@mubs.ac.ug` | Same, for their own courses |
| **Student** | `sarah.nakato@students.mubs.ac.ug` | View available courses, register and drop courses, view own registrations, timetable and results |
| Student | `john.okello@…`, `daniel.ssempijja@…`, `aisha.namuli@…`, `patience.achan@…` (all `@students.mubs.ac.ug`) | Same |
| Student (Suspended) | `kevin.mugabi@students.mubs.ac.ug` | Can sign in but **cannot** register courses |
| *Pending* | `hassan.kato@gmail.com`, `doreen.nantongo@gmail.com`, `florence.nabukenya@gmail.com` | **Cannot sign in** until the Registrar approves them under *Approvals* |

### Permissions per role (created in `RolesAndPermissionsSeeder`)

| Permission | admin | lecturer | student |
| --- | :-: | :-: | :-: |
| view / create / edit / delete students | ✅ | | |
| view / create / edit / delete courses | ✅ | | |
| manage programmes, manage lecturers | ✅ | | |
| view registrations, manage registrations | ✅ | | |
| approve registrations, manage users, view reports | ✅ | | |
| view assigned courses, view course students, enter marks | | ✅ | |
| view available courses, register courses, view own registrations, view own results | | | ✅ |

### Registration and approval flow

1. A student or lecturer fills in **Register** (they choose the account type at the top).
2. Their account is saved as **pending** and they are logged out again (`App\Http\Responses\RegisterResponse`).
3. A pending or rejected user who tries to sign in gets a clear message (`Fortify::authenticateUsing` in `FortifyServiceProvider`).
4. The Registrar opens **Approvals** and approves them. Students get a student number and lecturers get a staff number.
5. They sign in and land on their dashboard.

---

## 3. How each coursework question is answered

### Question One — Database design and relationships

| Table (migration) | Model | Key points |
| --- | --- | --- |
| `users` (+ `add_status_to_users_table`) | `User` | Jetstream user + `status` (pending/approved/rejected) + Spatie `HasRoles` |
| `programmes` | `Programme` | unique `code` |
| `lecturers` | `Lecturer` | `user_id` FK (unique, cascade) |
| `students` | `Student` | `user_id` FK, `programme_id` FK, unique `student_number` and `email` |
| `courses` | `Course` | `programme_id` FK, `lecturer_id` FK (null on delete), unique `code` |
| `course_registrations` | `CourseRegistration` (pivot model) | `student_id` FK + `course_id` FK (cascade), **`unique(['student_id','course_id'])`** |

**Relationships**

- `hasMany`: `Programme::students()`, `Programme::courses()`, `Lecturer::courses()`, `Student::registrations()`, `Course::registrations()`
- `belongsTo`: `Student::programme()`, `Student::user()`, `Course::programme()`, `Course::lecturer()`, `Lecturer::user()`, `CourseRegistration::student()/course()`
- `belongsToMany`: `Student::courses()` ↔ `Course::students()` through `course_registrations` (`->using(CourseRegistration::class)->withPivot(...)->withTimestamps()`)
- `hasOne`: `User::student()`, `User::lecturer()`; `hasManyThrough`: `Lecturer::registrations()`

**Retrieving with Eloquent**

```php
$student->courses;   // a student's registered courses   (Admin\StudentController@show, Student\PortalController@dashboard)
$course->students;   // the students registered for a course (Admin\CourseController@show, Lecturer\CourseController@show)
```

**Duplicate prevention** works at three levels:

1. the database unique index;
2. the validation rule `Rule::unique('course_registrations')->where('student_id', …)`;
3. the check in `App\Services\CourseRegistrationService`, which also catches the database error from a double click.

### Question Two — Seeders

`DatabaseSeeder` → `RolesAndPermissionsSeeder`, `ProgrammeSeeder` (6), `UserSeeder` (1 admin, 5 lecturers, 8 students, 3 pending), `CourseSeeder` (8 courses), `CourseRegistrationSeeder` (14 registrations, some with marks).

Every seeder uses `firstOrCreate` / `updateOrCreate` on a unique key, and roles use `syncRoles` / `syncPermissions`. Running `php artisan db:seed` again never creates duplicates, and a test proves it.

### Question Three — Authentication, roles and permissions

- **(a) Authentication** — Jetstream (Fortify): login, register, forgot/reset password, profile, password change, 2FA, browser sessions.
- **(b) Roles and permissions** — created in `RolesAndPermissionsSeeder`.
- **(c) Assigning roles** — `syncRoles` in `UserSeeder`, `assignRole` on registration and admin create, and admins can change roles under *Users & roles*.
- **(d) Protecting routes** — in `routes/web.php`, `auth:sanctum` + Jetstream session + `approved` on every signed-in route, then `role:admin|lecturer|student` per area and `permission:...` per route or controller action (`HasMiddleware::middleware()`). The middleware aliases are in `bootstrap/app.php`.
- **(e) Other users' records** —
  - Policies: `StudentPolicy`, `CoursePolicy` (`viewStudents`, `enterMarks` — only the course's own lecturer) and `CourseRegistrationPolicy` (a student can drop only their own registration).
  - Student pages always use `auth()->user()->student`, never an id from the URL.
  - Unauthorized access shows a friendly 403 page.

### Question Four — Functionality

- **(a) Student CRUD** — `Admin\StudentController` (resource), with search, filters and pagination.
- **(b) Course CRUD** — `Admin\CourseController` (resource).
- **(c) Course registration** — students tick courses (`Student\CourseRegistrationController`), and admins register from the student page, the course page or *Registrations*. The rules: approved and Active student, no duplicates, course capacity, and a maximum of 27 credit units.
- **(d) Records per role** — each role has its own dashboard and pages, and lecturers only see their own courses.
- **(e) Messages** — success and error flash messages plus validation errors (`partials/flash.blade.php`).

**Extras:** programmes and lecturers CRUD, approvals, users & roles, reports, marks entry with automatic grades, timetable, results with CGPA, and a contact form.

### Question Five — Blade layouts and validation

- **(a) Reusable layout** — `layouts/app.blade.php` with `partials/topbar` (header), `partials/sidebar` (navigation), `{{ $slot }}` (content) and `partials/footer`. Also `layouts/guest.blade.php` for auth pages and `components/public-layout.blade.php` for the website.
- **(b) Views** — `resources/views/admin/students/*`, `admin/courses/*`, `admin/registrations/*`, `student/*`, `lecturer/*`.
- **(c) Validation** — Form Requests (`StudentRequest`, `CourseRequest`, `ProgrammeRequest`, `LecturerRequest`) and `$request->validate()` for registrations and marks. Errors show under each field (`x-ui.error`).
- **(d) Links by permission** — the sidebar shows a link only if `$user->can('<permission>')`, and buttons use `@can('update', $student)`, `@can('manage registrations')` and so on.

### Question Six — Documentation

This README covers installation and database setup, roles and credentials, and the screenshots below.

---

## 4. Screenshots

| | |
| --- | --- |
| Home page ![](docs/screenshots/01-home.png) | Sign in ![](docs/screenshots/02-login.png) |
| Register (student / lecturer) ![](docs/screenshots/03-register.png) | Pending account blocked ![](docs/screenshots/05-login-pending-blocked.png) |
| Registrar dashboard ![](docs/screenshots/10-admin-dashboard.png) | Approvals ![](docs/screenshots/11-admin-approvals.png) |
| Students list ![](docs/screenshots/13-admin-students.png) | Add student — validation ![](docs/screenshots/15-admin-student-validation.png) |
| Student record + registered courses ![](docs/screenshots/16-admin-student-show.png) | Course + registered students ![](docs/screenshots/22-admin-course-show.png) |
| Course units ![](docs/screenshots/20-admin-courses.png) | Duplicate registration rejected ![](docs/screenshots/27-admin-duplicate-registration.png) |
| Users & roles (Spatie) ![](docs/screenshots/28-admin-users-roles.png) | Reports ![](docs/screenshots/29-admin-reports.png) |
| Lecturer dashboard ![](docs/screenshots/40-lecturer-dashboard.png) | Lecturer class list ![](docs/screenshots/42-lecturer-class-list.png) |
| Enter marks ![](docs/screenshots/44-lecturer-marks-saved.png) | 403 — another lecturer's course ![](docs/screenshots/45-forbidden-403.png) |
| Student dashboard ![](docs/screenshots/50-student-dashboard.png) | Course registration ![](docs/screenshots/51-student-course-registration.png) |
| My registrations ![](docs/screenshots/52-student-registrations.png) | Timetable ![](docs/screenshots/53-student-timetable.png) |
| Results ![](docs/screenshots/54-student-results.png) | Mobile ![](docs/screenshots/61-mobile-student-dashboard.png) |

All screenshots are in `docs/screenshots/`.

---

## 5. Project structure (main files)

```
app/
  Actions/Fortify/CreateNewUser.php        self-registration (pending + role)
  Http/Controllers/Admin/*                 Dashboard, Student, Course, Programme, Lecturer,
                                           Registration, Approval, User, Report
  Http/Controllers/Lecturer/*              Dashboard, Course (class list), Mark
  Http/Controllers/Student/*               Portal (dashboard, timetable, results), CourseRegistration
  Http/Middleware/EnsureUserIsApproved.php
  Http/Requests/*                          Form Request validation
  Http/Responses/RegisterResponse.php      log out after registering
  Models/                                  User, Programme, Lecturer, Student, Course, CourseRegistration
  Policies/                                StudentPolicy, CoursePolicy, CourseRegistrationPolicy
  Services/CourseRegistrationService.php   registration rules
bootstrap/app.php                          Spatie middleware aliases, 403 handler
database/migrations/  database/seeders/
resources/views/layouts, partials, components/ui, admin, lecturer, student, auth
routes/web.php
tests/Feature/StudentManagementTest.php, RegistrationTest.php
```

See `docs/GITHUB_WORKFLOW.md` for the branch and pull-request plan, and `docs/CONTRIBUTION_REPORT.md` for the report template.

# GitHub collaboration plan

The brief requires:

- a shared repository;
- `main` for stable code and `develop` for integration;
- one feature branch per member, with pull requests into `develop`;
- regular, meaningful commits.

**Each member must push their own part from their own GitHub account**, because the lecturer checks the history. Below is a suggested split of this codebase into five feature areas. If your group is smaller, give one person two areas.

## Suggested split

| Member | Branch | Files they own and explain at the presentation |
| --- | --- | --- |
| 1 | `feature/database-relationships` | `database/migrations/*`, `app/Models/*` (relationships), `CourseRegistration` pivot |
| 2 | `feature/seeders-auth-roles` | `database/seeders/*`, `bootstrap/app.php`, `app/Http/Middleware/*`, `app/Providers/FortifyServiceProvider.php`, `app/Actions/Fortify/CreateNewUser.php`, `app/Http/Responses/*`, `app/Policies/*`, `routes/web.php` |
| 3 | `feature/student-management` | `Admin/StudentController`, `StudentRequest`, `resources/views/admin/students/*`, `Admin/ApprovalController`, `Admin/UserController` + views |
| 4 | `feature/course-management` | `Admin/CourseController`, `ProgrammeController`, `LecturerController`, their requests and views, `Lecturer/*` controllers and views |
| 5 | `feature/course-registration` | `Services/CourseRegistrationService.php`, `Admin/RegistrationController`, `Student/*` controllers and views, `Admin/ReportController` |
| All | `feature/layouts-docs` (one person) | `resources/views/layouts`, `partials`, `components/ui`, `auth/*`, `README.md`, `docs/*`, `tests/*` |

## Steps

**1. Group leader** — create the repository and push the base Laravel skeleton:

```bash
git init
git add composer.json artisan bootstrap config public package.json vite.config.js tailwind.config.js postcss.config.js .env.example .gitignore
git commit -m "chore: Laravel 12 skeleton with Jetstream and Spatie permission"
git branch -M main
git remote add origin https://github.com/<group>/student-management-system.git
git push -u origin main
git checkout -b develop
git push -u origin develop
```

**2. Each member:**

```bash
git clone https://github.com/<group>/student-management-system.git
cd student-management-system
git checkout develop
git checkout -b feature/student-management      # your branch
# add / change your files, then commit in small steps:
git add app/Http/Controllers/Admin/StudentController.php
git commit -m "feat(students): add student CRUD controller with permission middleware"
git push -u origin feature/student-management
```

**3. Pull request** — on GitHub, open a PR from `feature/...` into `develop`. Another member reviews it and comments, then merges it.

**4. Integration test** — once all PRs are in `develop`:

```bash
php artisan migrate:fresh --seed
php artisan test
```

Then click through all three roles.

**5. Release** — open a PR from `develop` to `main`, review it, and merge.

**Good commit messages:** `feat(courses): validate unique course code`, `fix(registration): block duplicate registration`, `docs: add sample credentials`.

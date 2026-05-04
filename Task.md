# 📌 DevTrack — TASKS_V2.md

## 👥 Team Structure

| Role | Responsibility |
|------|----------------|
| Dev A | Lead Flow (Project Owner) |
| Dev B | Developer Flow (Task Execution) |

---

# 🚀 DAY 1 — Setup & Foundation (Both)

| Type | Task | Command / Details |
|------|------|------------------|
| Setup | Create Laravel project | `laravel new devtrack` |
| Setup | Configure `.env` & DB | — |
| Auth | Install Breeze | `php artisan breeze:install` |
| Frontend | Install assets | `npm install && npm run dev` |
| DB | Run migrations | `php artisan migrate` |
| Tooling | Install Debugbar | `composer require barryvdh/laravel-debugbar --dev` |
| Tooling | Install Telescope | `php artisan telescope:install` |
| DB | Telescope migrate | `php artisan migrate` |
| Git | Setup workflow | main / dev / feature branches |

### 📚 Learning
| Topic |
|------|
| Auth flow |
| Middleware `auth` |
| Debugbar (N+1) |
| Telescope |

---

# 🚀 DAY 2 — Models & Relationships

## 👤 Dev A — Projects

| Type | Task | Command / Details |
|------|------|------------------|
| Model | Create Project | `php artisan make:model Project -m` |
| DB | Fields | title, description, deadline |
| Feature | SoftDeletes | `use SoftDeletes` |
| DB | Pivot table | project_user (role) |
| Relation | Many-to-many | users ↔ projects |

---

## 👤 Dev B — Tasks

| Type | Task | Command / Details |
|------|------|------------------|
| Model | Create Task | `php artisan make:model Task -m` |
| DB | Fields | title, description, status |
| DB | Fields | priority, deadline, assigned_user_id |
| Relation | Task → Project | belongsTo |
| Relation | Task → User | belongsTo |

---

## 📚 Learning (Both)

| Topic |
|------|
| Eloquent relationships |
| Pivot tables (role) |

---

# 🚀 DAY 3 — CRUD Features

## 👤 Dev A — Projects

| Type | Task | Command / Details |
|------|------|------------------|
| Controller | Create controller | `php artisan make:controller ProjectController --resource` |
| Validation | Store request | `php artisan make:request StoreProjectRequest` |
| Validation | Update request | `php artisan make:request UpdateProjectRequest` |
| CRUD | Create project | — |
| CRUD | Update project | — |
| CRUD | Delete project | — |
| Feature | Archive project | SoftDelete |
| Feature | Restore project | — |
| Members | Add member | via email |
| Members | Remove member | — |

---

## 👤 Dev B — Tasks

| Type | Task | Command / Details |
|------|------|------------------|
| Controller | Create controller | `php artisan make:controller TaskController` |
| Validation | Store request | `php artisan make:request StoreTaskRequest` |
| Validation | Update request | `php artisan make:request UpdateTaskRequest` |
| CRUD | Create task | — |
| CRUD | Update task | — |
| CRUD | Delete task | — |
| Feature | Assign developer | — |
| UI | Task list | status, user, priority, deadline |

---

## 📚 Learning

| Topic |
|------|
| Form Requests |
| Clean controllers |

---

# 🚀 DAY 4 — Authorization

## 👤 Dev A — ProjectPolicy

| Type | Task | Command / Details |
|------|------|------------------|
| Policy | Create | `php artisan make:policy ProjectPolicy --model=Project` |
| Rule | Lead only | update/delete/archive |
| Rule | Manage members | lead only |
| Config | Register policy | AuthServiceProvider |
| Usage | Controller auth | `$this->authorize()` |

---

## 👤 Dev B — TaskPolicy

| Type | Task | Command / Details |
|------|------|------------------|
| Policy | Create | `php artisan make:policy TaskPolicy --model=Task` |
| Rule | Lead | full access |
| Rule | Dev | status only |
| Security | Restrict fields | no title/description edit |

---

## 👥 Both

| Task |
|------|
| Use `@can` in Blade |
| Hide unauthorized actions |

---

## 📚 Learning

| Topic |
|------|
| Policies |
| Authorization flow |

---

# 🚀 DAY 5 — Advanced Features & API

## 👤 Dev A

| Type | Task | Command / Details |
|------|------|------------------|
| UI | Dashboard | projects + stats |
| Data | Total tasks | count |
| Data | Completed tasks | count |
| Mutator | Title format | `setTitleAttribute()` |
| Perf | Eager loading | `with()` |

---

## 👤 Dev B

| Type | Task | Command / Details |
|------|------|------------------|
| API | Route | `/api/projects/{project}/tasks` |
| Resource | Create | `php artisan make:resource TaskResource` |
| Accessor | Status label | `getStatusLabelAttribute()` |
| Accessor | Deadline status | `getDeadlineStatusAttribute()` |
| Scope | Urgent tasks | `scopeUrgent()` |

---

## 📚 Learning

| Topic |
|------|
| API Resources |
| Accessors / Mutators |
| Scopes |

---

# 🎯 BONUS (Both)

| Task | Details |
|------|--------|
| Archive | SoftDeletes |
| Restore | — |
| Force delete | `forceDelete()` |
| Performance | Fix N+1 with `with()` |
| Debug | Use Debugbar |

---

# 🧪 DEBUG PREPARATION

| Task |
|------|
| Inspect requests (Telescope) |
| Analyze SQL queries |
| Detect errors |
| Simulate unauthorized access |
| Test API responses |

---

# ✅ FINAL CHECKLIST

| Check |
|------|
| Policies everywhere |
| No manual `abort(403)` |
| Form Requests used |
| SoftDeletes working |
| Clean API JSON |
| Accessors used |
| No N+1 queries |


# 📌 DevTrack — TASKS.md

## 👥 Team Structure

- **Dev A → Lead Flow (Project Owner)**
- **Dev B → Developer Flow (Task Execution)**

🎯 Both developers work on:
- Backend  
- Frontend  
- Security (Policies)  
- Advanced Laravel features  

---

# 🚀 DAY 1 — Setup & Foundation (Both)
## 🔧 Tasks

- [X] Create Laravel project  
```bash
laravel new devtrack
```
- [X] Configure .env and database
- [X] Install authentication (Breeze)
```bash
php artisan breeze:install
npm install && npm run dev
php artisan migrate
```
- [X] Install Debugbar
```bash
composer require barryvdh/laravel-debugbar --dev
```
- [X] Install Telescope
```bash
php artisan telescope:install
php artisan migrate
```
- [ ] Setup Git workflow:

    - main / dev branches

    - feature branches

    - PR + reviews

## 📚 Learning
- [ ] Laravel authentication flow

- [ ] Middleware auth

- [ ] Debugbar (N+1 detection)

- [ ] Telescope (requests & queries)

# 🚀 DAY 2 — Models & Relationships
## 👤 Dev A — Projects Core
- [ ] Create Project model + migration
```bash
php artisan make:model Project -m
```
- [ ] Add fields:

    - title

    - description

    - deadline

- [ ] Add SoftDeletes
```bash
use SoftDeletes;
```
- [ ] Create pivot table: project_user

    - user_id

    - project_id

    - role (lead / developer)

- [ ] Define relationships:
```bash
// Project.php
public function users()
{
    return $this->belongsToMany(User::class)->withPivot('role');
}
```
## 👤 Dev B — Tasks Core
- [ ] Create Task model + migration

php artisan make:model Task -m
- [ ] Add fields:

    - title

    - description

    - status (todo, in_progress, done)

    - priority (low, medium, high)

    - deadline

    - assigned_user_id

- [ ] Define relationships:
```bash
// Task.php
public function project()
{
    return $this->belongsTo(Project::class);
}

public function user()
{
    return $this->belongsTo(User::class, 'assigned_user_id');
}
```
## 📚 Learning (Both)
- [ ] Eloquent relationships

- [ ] Pivot tables with extra column

# 🚀 DAY 3 — CRUD Features
## 👤 Dev A — Projects
- [ ] Create controller
```bash
php artisan make:controller ProjectController --resource
```
- [ ] Create Form Requests
```bash
php artisan make:request StoreProjectRequest
php artisan make:request UpdateProjectRequest
```
- [ ] Implement:

    - Create project

    - Update project

    - Delete project

    - Archive project (SoftDelete)

    - Restore project

    - Manage members:

    - Add member by email

    - Remove member

## 👤 Dev B — Tasks
- [ ] Create controller
```bash
php artisan make:controller TaskController
```
- [ ] Create Form Requests
```bash
php artisan make:request StoreTaskRequest
php artisan make:request UpdateTaskRequest
```
- [ ] Implement:

    - Create task

    - Update task

    - Delete task

    - Assign developer

- [ ] Build Task UI:

    - Show status

    - Show assigned user

    - Show priority

    - Show deadline

## 📚 Learning
- [ ] Form Requests validation

- [ ] Clean controller logic

# 🚀 DAY 4 — Authorization (CRITICAL)
## 👤 Dev A — ProjectPolicy
- [ ] Create policy
```bash
php artisan make:policy ProjectPolicy --model=Project
```
- [ ] Define rules:

    - Only lead can:

        - update

        - delete

        - archive

        - manage members

- [ ] Register policy in AuthServiceProvider

- [ ] Use in controller:
```bash
$this->authorize('update', $project);
```
## 👤 Dev B — TaskPolicy
- [ ] Create policy
```bash
php artisan make:policy TaskPolicy --model=Task
```
- [ ] Define rules:

    - Lead → full access

    - Developer → only update status

- [ ] Restrict:

❌ No editing title/description

## 👥 Both
- [ ] Use Blade authorization:
```bash
@can('update', $project)
    <button>Edit</button>
@endcan
```
- [ ] Hide unauthorized UI actions

## 📚 Learning
- [ ] Policies

- [ ] Authorization flow

# 🚀 DAY 5 — Advanced Features & API
## 👤 Dev A — Dashboard & Optimization
- [ ] Build dashboard:

    - Show projects

    - Count total tasks

    - Count completed tasks

- [ ] Add mutator:
```bash
public function setTitleAttribute($value)
{
    $this->attributes['title'] = ucfirst($value);
}
```
- [ ] Optimize queries:
```bash
Project::with('tasks')->get();
```
## 👤 Dev B — API & Smart Logic
- [ ] Create API route:
```bash
Route::get('/projects/{project}/tasks', ...);
```
- [ ] Create Resource:
```bash
php artisan make:resource TaskResource
```
- [ ] Add Accessors:
```bash
public function getStatusLabelAttribute()
{
    return match($this->status) {
        'todo' => 'À faire',
        'in_progress' => 'En cours',
        'done' => 'Terminé',
    };
```
- [ ] Add Scope:
```bash
public function scopeUrgent($query)
{
    return $query->where('deadline', '<=', now()->addHours(48))
                 ->where('status', '!=', 'done');
}
```
## 📚 Learning
- [ ] API Resources

- [ ] Accessors & Mutators

- [ ] Local Scopes

## 🎯 BONUS (Both)
- [ ] Archive project

- [ ] Restore project

- [ ] Force delete
```bash
$project->forceDelete();
```
- [ ] Fix N+1 queries using:
```bash
with()
```
- [ ] Verify with Debugbar

## DEBUG PREPARATION
- [ ] Use Telescope to inspect:

    - requests

    - SQL queries

    - exceptions

- [ ] Simulate:

    - unauthorized access

    - API calls

    - bugs


✅ FINAL CHECKLIST
- [ ] Policies everywhere

- [ ] No manual abort(403)

- [ ] Form Requests used

- [ ] SoftDeletes working

- [ ] Clean API JSON

- [ ] Accessors used

- [ ] No N+1 queries
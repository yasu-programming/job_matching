# Database Migration Testing Guide

This document provides instructions for testing the database migrations created for the job matching platform.

## Migration Files Overview

The following migration files have been created in the correct dependency order:

1. `2024_01_01_000003_extend_users_table.php` - Extends the base users table
2. `2024_01_01_000004_create_companies_table.php` - Company profiles
3. `2024_01_01_000005_create_jobseeker_profiles_table.php` - Jobseeker profiles
4. `2024_01_01_000006_create_job_postings_table.php` - Job postings
5. `2024_01_01_000007_create_applications_table.php` - Job applications
6. `2024_01_01_000008_create_messages_table.php` - Messaging system (conversations + messages)
7. `2024_01_01_000009_create_notifications_table.php` - Notification system
8. `2024_01_01_000010_create_resumes_table.php` - Resume management
9. `2024_01_01_000011_create_scouts_table.php` - Company scouting functionality
10. `2024_01_01_000012_create_matches_table.php` - Job matching algorithm data
11. `2024_01_01_000013_create_interview_schedules_table.php` - Interview scheduling
12. `2024_01_01_000014_add_scout_id_to_conversations.php` - Links conversations to scouts

## Testing Instructions

### Prerequisites

1. Ensure Docker and Laravel Sail are properly set up
2. Copy `.env.example` to `.env` and configure database settings
3. Install dependencies: `composer install`

### Running Migrations

```bash
# Start the application containers
./vendor/bin/sail up -d

# Run all migrations
./vendor/bin/sail artisan migrate

# Check migration status
./vendor/bin/sail artisan migrate:status
```

### Testing Rollbacks

```bash
# Rollback all custom migrations (keeping Laravel defaults)
./vendor/bin/sail artisan migrate:rollback --step=12

# Or rollback specific batches
./vendor/bin/sail artisan migrate:rollback --batch=2
```

### Verification Queries

Once migrations are run, you can verify the database structure:

```sql
-- Check all tables were created
SHOW TABLES;

-- Verify users table structure
DESCRIBE users;

-- Check foreign key constraints
SELECT 
  TABLE_NAME,
  COLUMN_NAME,
  CONSTRAINT_NAME,
  REFERENCED_TABLE_NAME,
  REFERENCED_COLUMN_NAME
FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
WHERE TABLE_SCHEMA = 'job_matching' AND REFERENCED_TABLE_NAME IS NOT NULL;

-- Check indexes
SELECT 
  TABLE_NAME,
  INDEX_NAME,
  COLUMN_NAME
FROM INFORMATION_SCHEMA.STATISTICS
WHERE TABLE_SCHEMA = 'job_matching'
ORDER BY TABLE_NAME, INDEX_NAME;
```

## Expected Database Schema

After running all migrations, you should have the following tables:

- `users` (extended with job matching fields)
- `companies`
- `jobseeker_profiles`
- `job_postings`
- `applications`
- `conversations`
- `messages`
- `notifications`
- `resumes`
- `scouts`
- `matches`
- `interview_schedules`

Plus the default Laravel tables:
- `password_reset_tokens`
- `sessions`
- `cache`
- `cache_locks`
- `jobs`
- `job_batches`
- `failed_jobs`

## Troubleshooting

### Common Issues

1. **Foreign key constraint errors**: Ensure migrations run in the correct order
2. **Column type mismatches**: Check that ENUM values match exactly
3. **Index name conflicts**: Laravel auto-generates index names, conflicts are rare but possible

### Manual Testing

If you encounter issues, you can run migrations individually:

```bash
./vendor/bin/sail artisan migrate --path=database/migrations/2024_01_01_000003_extend_users_table.php
```

### Recovery

If migrations fail partway through:

```bash
# Check which migrations completed
./vendor/bin/sail artisan migrate:status

# Reset migrations (⚠️ destroys data)
./vendor/bin/sail artisan migrate:fresh
```

## Notes

- All migration files have been validated for PHP syntax
- Foreign key dependencies are properly ordered
- Rollback functionality is implemented for all migrations
- Index optimization follows Laravel conventions
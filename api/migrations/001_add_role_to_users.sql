-- Backup your database before running this migration.
-- Adds `role` and `created_at` columns to `users` if they don't exist.
ALTER TABLE users
  ADD COLUMN role ENUM('user','admin') NOT NULL DEFAULT 'user',
  ADD COLUMN created_at DATETIME NULL DEFAULT NULL;

-- Optional: ensure index on role for admin queries
CREATE INDEX idx_users_role ON users (role);

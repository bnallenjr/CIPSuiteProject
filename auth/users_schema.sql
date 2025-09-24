IF NOT EXISTS (SELECT * FROM sys.tables WHERE name = 'Users' AND schema_id = SCHEMA_ID('dbo'))
BEGIN
  CREATE TABLE dbo.Users (
      id INT IDENTITY(1,1) PRIMARY KEY,
      username NVARCHAR(100) NOT NULL UNIQUE,
      password_hash NVARCHAR(255) NOT NULL,
      role NVARCHAR(50) NOT NULL DEFAULT 'user',
      created_at DATETIME2 NOT NULL DEFAULT SYSUTCDATETIME()
  );
END;
GO
-- Example insert (replace hash):
-- INSERT INTO dbo.Users (username, password_hash, role) VALUES ('admin', '<bcrypt-hash-here>', 'admin');

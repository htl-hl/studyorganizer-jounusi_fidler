USE studyScript;

INSERT INTO User (Name, Email, PasswordHash, IsAdmin) VALUES
('Saasmann',   'Saasmann.Saasfrau@gmail.com',     '$2y$13$6BZKJibpXcbIBYhTJyID.O16fRBMN9TT5e.oCl5NAJbVpw3WR9coC', 0),
('Admin',      'admin.schmadmin@gmail.com',        '$2y$13$oPPteGiUfWquOZbN1DwkW.CQYxkdEXPUR1xcr.trjBATVggmEfpHy', 1),
('Saaslehrer', 'Saaslehrer.Saaslehrer@gmail.com',  '$2y$13$e9NtWHo4QiBIWz1MZnkUpej496CXnZa2HaOOMtqAlyk1fO9nUvzWq', 0);
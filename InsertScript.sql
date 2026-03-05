USE studyScript;

-- User
INSERT INTO User (Name, Email, PasswordHash, IsAdmin) VALUES
('Saasmann',   'Saasmann.Saasfrau@gmail.com',     '$2y$13$6BZKJibpXcbIBYhTJyID.O16fRBMN9TT5e.oCl5NAJbVpw3WR9coC', 0),
('Admin',      'admin.schmadmin@gmail.com',        '$2y$13$oPPteGiUfWquOZbN1DwkW.CQYxkdEXPUR1xcr.trjBATVggmEfpHy', 1),
('Saaslehrer', 'Saaslehrer.Saaslehrer@gmail.com',  '$2y$13$e9NtWHo4QiBIWz1MZnkUpej496CXnZa2HaOOMtqAlyk1fO9nUvzWq', 0);

-- Fächer
INSERT INTO Fach (Fachname, Beschreibung) VALUES
('Mathematik',       'Algebra, Geometrie und Analyse'),
('Deutsch',          'Grammatik, Literatur und Aufsatz'),
('Englisch',         'Grammatik, Vokabular und Konversation'),
('Informatik',       'Programmierung, Datenbanken und Netzwerke'),
('Geschichte',       'Weltgeschichte und österreichische Geschichte'),
('Physik',           'Mechanik, Elektrizität und Optik');

-- Lehrer
INSERT INTO Lehrer (Name, Email, IsActive) VALUES
('Prof. Huber',      'huber@schule.at',      1),
('Mag. Müller',      'mueller@schule.at',    1),
('Dr. Schneider',    'schneider@schule.at',  1),
('Prof. Wagner',     'wagner@schule.at',     0); -- inaktiver Lehrer

-- Fach-Lehrer Zuordnungen
INSERT INTO FachLehrer (FachID, LehrerID) VALUES
(1, 1), -- Mathematik -> Prof. Huber
(2, 2), -- Deutsch -> Mag. Müller
(3, 2), -- Englisch -> Mag. Müller
(4, 3), -- Informatik -> Dr. Schneider
(5, 4), -- Geschichte -> Prof. Wagner (inaktiv)
(6, 1); -- Physik -> Prof. Huber

-- Aufgaben (UserID 1 = Saasmann, UserID 3 = Saaslehrer)
INSERT INTO Aufgabe (Titel, Beschreibung, DueDate, Finished, UserID, FachID) VALUES
('Algebra Übungsblatt',         'Seite 45-47, Aufgaben 1-10',           '2026-03-20 23:59:00', 0, 1, 1),
('Aufsatz schreiben',           'Erörterung zum Thema Klimawandel',      '2026-03-08 23:59:00', 0, 1, 2),
('Vokabeln lernen Unit 5',      'Alle Vokabeln aus Unit 5 auswendig',    '2026-03-05 23:59:00', 0, 1, 3),
('Datenbank Projekt',           'ER-Diagramm und SQL Skript erstellen',  '2026-03-15 23:59:00', 0, 1, 4),
('Mittelalter Zusammenfassung', 'Kapitel 3 und 4 zusammenfassen',        '2026-03-10 23:59:00', 1, 1, 5), -- erledigt
('Newton Gesetze',              'Die drei Newtonschen Gesetze lernen',   '2026-03-03 23:59:00', 0, 1, 6), -- fast fällig
('Englisch Referat',            'Präsentation über London vorbereiten',  '2026-03-25 23:59:00', 0, 3, 3),
('Mathe Schularbeit vorbereiten','Alle Themen aus Kapitel 1-3 wiederholen','2026-03-12 23:59:00', 0, 3, 1);
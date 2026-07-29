USE student_management;
GO

-- Users
INSERT INTO Users (FullName, Email, Password, Role)
VALUES
('Admin User', 'admin@gmail.com', '123456', 'Admin'),
('Teacher One', 'teacher@gmail.com', '123456', 'Teacher');

-- Classes
INSERT INTO Classes (ClassName)
VALUES
('BSCS-1'),
('BSCS-2'),
('BBA-1');

-- Subjects
INSERT INTO Subjects (SubjectName, ClassID)
VALUES
('Programming Fundamentals', 1),
('Database Systems', 1),
('English', 2),
('Marketing', 3);

-- Students
INSERT INTO Students
(RollNo, StudentName, FatherName, Email, Phone, Gender, DOB, Address, Photo, ClassID)
VALUES
('BSCS001', 'Ali Khan', 'Ahmed Khan', 'ali@gmail.com', '03001234567', 'Male', '2004-05-10', 'Lahore', 'ali.jpg', 1),

('BSCS002', 'Sara Ahmed', 'Aslam Ahmed', 'sara@gmail.com', '03111234567', 'Female', '2005-02-15', 'Karachi', 'sara.jpg', 1),

('BBA001', 'Hamza Ali', 'Naveed Ali', 'hamza@gmail.com', '03221234567', 'Male', '2003-08-20', 'Multan', 'hamza.jpg', 3);
GO
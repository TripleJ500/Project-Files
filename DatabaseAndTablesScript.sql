CREATE DATABASE student_information;
USE student_information;

CREATE TABLE advisor (
	advisorID VARCHAR(6),
    lastName VARCHAR(50),
    firstName VARCHAR(50),
    initials VARCHAR(3),
    jobTitle VARCHAR(128),
    department VARCHAR(50),
    PRIMARY KEY (advisorID)
);

CREATE TABLE student (
	studentID VARCHAR(9),
    lastName VARCHAR(50),
    firstName VARCHAR(50),
    initials VARCHAR(3),
    major VARCHAR(128),
    advisorID VARCHAR(6),
    PRIMARY KEY (studentID),
    FOREIGN KEY (advisorID) REFERENCES advisor(advisorID)
);

CREATE TABLE course (
	coursePrefix VARCHAR(9),
    courseName VARCHAR(50),
    creditHours INT,
    PRIMARY KEY (coursePrefix)
);

CREATE TABLE grade (
	gradeID INT,
    studentID VARCHAR(9),
    coursePrefix VARCHAR(9),
    semester VARCHAR(6),
    grade DECIMAL(5, 2),
    PRIMARY KEY (gradeID),
    FOREIGN KEY (studentID) REFERENCES student(studentID),
    FOREIGN KEY (coursePrefix) REFERENCES course(coursePrefix)
);

ALTER TABLE student
ADD CONSTRAINT advisorID
FOREIGN KEY (advisorID) REFERENCES advisor(advisorID)
ON DELETE SET NULL;
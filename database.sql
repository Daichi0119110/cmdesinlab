drop database cmlab;

create database cmlab;

grant all on cmlab.* to dbuser@localhost identified by 'cmlab2016';
/*grant all on cmlab.* to LAA0628410@mysql024.phy.lolipop.lan by 'cmlab2016'*/

use cmlab;

create table users (
    id int not null auto_increment primary key,
    name varchar(50),
    class_id int,
    teacher_flg int
);

create table classes (
    id int not null auto_increment primary key,
    name varchar(255)
);

create table questions (
    id int not null auto_increment primary key,
    question varchar(255),
    class_id int,
    choice1 varchar(255),
    choice2 varchar(255),
    choice3 varchar(255),
    choice4 varchar(255),
    correct int
);

create table answers (
    id int not null auto_increment primary key,
    answer int,
    user_id int,
    question_id int
);

create table evaluations (
    id int not null auto_increment primary key,
    user_id int,
    subject int,
    evaluation int
);

insert into classes (name) values ("cmdesignlab");
insert into classes (name) values ("economy");

insert into users (name, class_id, teacher_flg) values ("Daichi Ogihara", 1, 0);
insert into users (name, class_id, teacher_flg) values ("Kazuki Otsuka", 1, 0);
insert into users (name, class_id, teacher_flg) values ("Yuki Taoka", 1, 0);
insert into users (name, class_id, teacher_flg) values ("Celine Mougenot", 1, 1);
insert into users (name, class_id, teacher_flg) values ("Celine Mougenot", 2, 1);
insert into users (name, class_id, teacher_flg) values ("Daichi Ogihara", 2, 0);

insert into questions (question, class_id, choice1, choice2, choice3, choice4, correct) values ("Who is Daichi Ogihara?", 1, "He is Genous!", "He is handsome man!", "He is from Korea", "He is American", 2);
insert into questions (question, class_id, choice1, choice2, choice3, choice4, correct) values ("Which is the best for goal of this app?", 1, "to motivate students", "to play", "to learn programming", "to satisfy myself", 1);
insert into questions (question, class_id, choice1, choice2, choice3, choice4, correct) values ("What is the goal of this class?", 2, "to learn basic skill", "to get units", "to be relax", "to do homework of other class", 1);

insert into answers (answer, user_id, question_id) values (1, 1, 1);
insert into answers (answer, user_id, question_id) values (2, 2, 1);
insert into answers (answer, user_id, question_id) values (2, 3, 1);
insert into answers (answer, user_id, question_id) values (1, 1, 2);
insert into answers (answer, user_id, question_id) values (1, 2, 2);
insert into answers (answer, user_id, question_id) values (1, 3, 2);

insert into evaluations (user_id, subject, evaluation) values (1, 2, 5);
insert into evaluations (user_id, subject, evaluation) values (1, 3, 4);
insert into evaluations (user_id, subject, evaluation) values (2, 1, 3);
insert into evaluations (user_id, subject, evaluation) values (2, 3, 5);
insert into evaluations (user_id, subject, evaluation) values (3, 1, 4);
insert into evaluations (user_id, subject, evaluation) values (3, 2, 5);

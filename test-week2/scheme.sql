create table seminar(
id int auto_increment primary key,
name varchar(40) not null,
status int not null,
subject int,
difficulty int,
day varchar(20),
start_time time,
type int,
approval int default 1,
content varchar(1000)
);

create table status(
status_id int primary key,
name varchar(20)
);

create table type(
type_id int primary key,
name varchar(30)
);

create table subject(
subject_id int primary key,
name varchar(30)
);


create table keyword(
word_id int auto_increment primary key,
keyword varchar(40),
seminar_id int
);

create table member(
member_id int auto_increment primary key,
name varchar(30)
);

create table belong(
seminar_id int,
member_id int,
is_organizer bit,
primary key(seminar_id, member_id)
);

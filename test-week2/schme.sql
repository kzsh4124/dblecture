create table seminar(
id int auto_increment primary key,
name varchar(40) not null,
status int not null,
subject int,
difficulty int,
day int not null,
start_time time,
type int
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

crete table member(
member_id int auto_increment primary key,
name varchar(30)
);

create table belong(
seminar_id int,
member_id int,
is_organizer bit,
primary key(seminar_id, member_id)
);

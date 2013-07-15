CREATE TABLE user (
  id bigint not null auto_increment ,
  firstName varchar(100),
  lastName varchar(100),
  email varchar(100),
  birthYear int,
  city varchar(100),
  constraint user_pk primary key (id)
);
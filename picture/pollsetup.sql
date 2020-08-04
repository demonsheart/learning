use test;
CREATE TABLE poll_results(
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  candidate VARCHAR (30),
  num_votes INT
);
INSERT INTO
  poll_results(candidate, num_votes)
VALUES
  ('John Smith', 0),
  ('Mary Jones', 0),
  ('Fred Bloggs', 0);

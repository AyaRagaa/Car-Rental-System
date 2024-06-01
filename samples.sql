-- Office
INSERT INTO `office` (`city`, `country`) VALUES
('Alexandria', 'Egypt'),
('Cairo', 'Egypt'),
('Dahab', 'Egypt'),
('Sharm ElSheikh', 'Egypt'),
('Hurghada', 'Egypt'),
('Luxor', 'Egypt'),
('Aswan', 'Egypt'),
('Port Said', 'Egypt'),
('Makkah', 'Saudia Arabia'),
('Riyadh', 'Saudia Arabia'),
('Madina', 'Saudia Arabia'),
('Dammam', 'Saudia Arabia'),
('Khobar', 'Saudia Arabia');

--Car
INSERT INTO car (num_plate, letter_plate,model,year,status,image_path,price,office_id,color) VALUES
('2367','ABD','Series 7','2021','active','img/bmwseries_7.png','5000','1','grey'),
('1234','ABC','Series 5','2013','active','img/black-bmw-m5-2013.png','3000','1','black'),
('7810','AEA','S','2013','active','img/tesla-modelS.png','4400','2','white'),
('7653','NSH','S','2017','active','img/mercedes-c-2017-blue.png','5100','2','blue'),
('7793','AAR','S4','2018','active','img/audi-s4-2018.png','5100','2','red');

--Customer
INSERT INTO Customer (user_id, first_name, last_name, phoneNumber, email, `password`, isAdmin, gender, bDate) VALUES
('ayara','Aya','Ragaa','01234567890', 'aya.ra@hotmail.com', '123', '1' ,'F', '21-5-2002');
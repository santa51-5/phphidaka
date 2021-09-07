create table tb_DOC_Master (
ID_CAL varchar(20) NULL comment 'CALID' ,
NN_acceptance_verification_name varchar(50) NULL comment '校正証明書名称' ,
DATE_issuing date NULL comment '発行日' ,
NOTE_DOC varchar(50) NULL comment '備考' ,
NN_DOC_Name varchar(50)  comment 'ファイル名' 

) ENGINE=InnoDB;

create table tb_info (
NO_info tinyint(2) NULL comment 'No' ,
content_classification varchar(20) NULL comment '���e����' ,
INFO_date datetime NULL comment '���t' ,
INFO_content varchar(50) NULL comment '���e' ,
INFO_notice_presence bit NULL comment '�f���̗L��' ,
INFO_mark_presence bit NULL comment '�}�[�N�̗L��' ,
INFO_admin bit  comment 'admin' 

) ENGINE=InnoDB;

create table tb_info (
NO_info tinyint(2) NULL comment 'No' ,
content_classification varchar(20) NULL comment '内容分類' ,
INFO_date datetime NULL comment '日付' ,
INFO_content varchar(50) NULL comment '内容' ,
INFO_notice_presence bit NULL comment '掲示の有無' ,
INFO_mark_presence bit NULL comment 'マークの有無' ,
INFO_admin bit  comment 'admin' 

) ENGINE=InnoDB;

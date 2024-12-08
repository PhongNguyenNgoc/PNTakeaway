/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     09/12/2024 2:27:11 SA                        */
/*==============================================================*/


drop table if exists CHI_TIET_DON_HANG;

drop table if exists DON_HANG;

drop table if exists GIO_HANG;

drop table if exists LOAI_MON_AN;

drop table if exists MON_AN;

drop table if exists TAI_KHOAN;

/*==============================================================*/
/* Table: CHI_TIET_DON_HANG                                     */
/*==============================================================*/
create table CHI_TIET_DON_HANG
(
   ID_CTDD              int not null auto_increment,
   ID_MONAN             int,
   ID_DONDAT            int,
   SOLUONG              bigint not null,
   primary key (ID_CTDD)
);

/*==============================================================*/
/* Table: DON_HANG                                              */
/*==============================================================*/
create table DON_HANG
(
   ID_DONDAT            int not null auto_increment,
   TENNGUOIDUNG         char(10),
   NGAYDATHANG          datetime not null,
   TRANGTHAI            int,
   CHITIET              varchar(500),
   THANHTOAN            char(20),
   TONGGTDONHANG        bigint,
   primary key (ID_DONDAT)
);

/*==============================================================*/
/* Table: GIO_HANG                                              */
/*==============================================================*/
create table GIO_HANG
(
   ID_GIOHANG           int not null auto_increment,
   ID_MONAN             int,
   TENNGUOIDUNG         char(10),
   SOLUONG              bigint not null,
   primary key (ID_GIOHANG)
);

/*==============================================================*/
/* Table: LOAI_MON_AN                                           */
/*==============================================================*/
create table LOAI_MON_AN
(
   ID_LOAIMONAN         int not null auto_increment,
   TENLOAI              varchar(500) not null,
   primary key (ID_LOAIMONAN)
);

/*==============================================================*/
/* Table: MON_AN                                                */
/*==============================================================*/
create table MON_AN
(
   ID_MONAN             int not null auto_increment,
   ID_LOAIMONAN         int not null,
   TENMONAN             varchar(500) not null,
   GIATIEN              bigint not null,
   CHITIETMONAN         varchar(255) not null,
   TRANGTHAI            int not null,
   ANH                  varchar(255) not null,
   primary key (ID_MONAN)
);

/*==============================================================*/
/* Table: TAI_KHOAN                                             */
/*==============================================================*/
create table TAI_KHOAN
(
   TENNGUOIDUNG         char(10) not null,
   MATKHAU              varchar(255) not null,
   QUYEN                int not null,
   HOVATEN              varchar(500) not null,
   SDT                  char(10) not null,
   EMAIL                varchar(500) not null,
   DIACHI               varchar(500) not null,
   TOKEN                varchar(255),
   primary key (TENNGUOIDUNG)
);

alter table CHI_TIET_DON_HANG add constraint FK_COB foreign key (ID_DONDAT)
      references DON_HANG (ID_DONDAT) on delete restrict on update restrict;

alter table CHI_TIET_DON_HANG add constraint FK_CO_TRONG foreign key (ID_MONAN)
      references MON_AN (ID_MONAN) on delete restrict on update restrict;

alter table DON_HANG add constraint FK_SO_HUU foreign key (TENNGUOIDUNG)
      references TAI_KHOAN (TENNGUOIDUNG) on delete restrict on update restrict;

alter table GIO_HANG add constraint FK_THUOCA foreign key (TENNGUOIDUNG)
      references TAI_KHOAN (TENNGUOIDUNG) on delete restrict on update restrict;

alter table GIO_HANG add constraint FK_TRONG foreign key (ID_MONAN)
      references MON_AN (ID_MONAN) on delete restrict on update restrict;

alter table MON_AN add constraint FK_THUOC foreign key (ID_LOAIMONAN)
      references LOAI_MON_AN (ID_LOAIMONAN) on delete restrict on update restrict;


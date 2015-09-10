/*==============================================================*/
/* DBMS name:      PostgreSQL 8                                 */
/* Created on:     4/29/2015 10:18:02 PM                        */
/*==============================================================*/



/*==============================================================*/
/* Table: ANUNCIO                                               */
/*==============================================================*/
create table ANUNCIO (
   PK_ANUNCIO           SERIAL               not null,
   PK_USUARIO           INT4                 null,
   VCH_ANUNTITULO       TEXT                 not null,
   VCH_ANUNCONTENIDO    TEXT                 null,
   VCH_ANUNFOTO         TEXT                 null,
   DTT_ANUNFECHAINICIO  DATE                 not null,
   DTT_ANUNFECHAFIN     DATE                 not null,
   VCH_ANUNESTADO       CHAR(1)              not null,
   constraint PK_ANUNCIO primary key (PK_ANUNCIO)
);

/*==============================================================*/
/* Index: ANUNCIO_PK                                            */
/*==============================================================*/
create unique index ANUNCIO_PK on ANUNCIO (
PK_ANUNCIO
);

/*==============================================================*/
/* Index: RELATIONSHIP_14_FK                                    */
/*==============================================================*/
create  index RELATIONSHIP_14_FK on ANUNCIO (
PK_USUARIO
);

/*==============================================================*/
/* Table: APORTE                                                */
/*==============================================================*/
create table APORTE (
   PK_APORTE            SERIAL               not null,
   PK_GESTION           INT4                 null,
   PK_USUARIO           INT4                 null,
   DAT_INGRFECHA        DATE                 null,
   INT_INGRMONTO        INT4                 null,
   VCH_INGRNOTADETALLE  TEXT                 null,
   VCH_INGRCONCEPTOINGRESOEGRESO TEXT                 null,
   VCH_INGRMETODOPAGO   TEXT                 null,
   VCH_INGRTIPOESTADOIE CHAR(1)              null,
   constraint PK_APORTE primary key (PK_APORTE)
);

/*==============================================================*/
/* Index: APORTE_PK                                             */
/*==============================================================*/
create unique index APORTE_PK on APORTE (
PK_APORTE
);

/*==============================================================*/
/* Index: RELATIONSHIP_9_FK                                     */
/*==============================================================*/
create  index RELATIONSHIP_9_FK on APORTE (
PK_GESTION
);

/*==============================================================*/
/* Index: RELATIONSHIP_12_FK                                    */
/*==============================================================*/
create  index RELATIONSHIP_12_FK on APORTE (
PK_USUARIO
);

/*==============================================================*/
/* Table: ASIGNADO                                              */
/*==============================================================*/
create table ASIGNADO (
   PK_ASIGNADO          SERIAL               not null,
   PK_PRIVILEGIO        INT4                 null,
   PK_ROL               INT4                 null,
   INT_ASIGPRIVILEGIOASIGNADO INT4                 not null,
   VCH_ASIGDESCRIPCION  TEXT                 null,
   constraint PK_ASIGNADO primary key (PK_ASIGNADO)
);

/*==============================================================*/
/* Index: ASIGNADO_PK                                           */
/*==============================================================*/
create unique index ASIGNADO_PK on ASIGNADO (
PK_ASIGNADO
);

/*==============================================================*/
/* Index: RELATIONSHIP_1_FK                                     */
/*==============================================================*/
create  index RELATIONSHIP_1_FK on ASIGNADO (
PK_PRIVILEGIO
);

/*==============================================================*/
/* Index: RELATIONSHIP_2_FK                                     */
/*==============================================================*/
create  index RELATIONSHIP_2_FK on ASIGNADO (
PK_ROL
);

/*==============================================================*/
/* Table: CONCEPTOINGRESOEGRESO                                 */
/*==============================================================*/
create table CONCEPTOINGRESOEGRESO (
   PK_CONCEPTO          SERIAL               not null,
   PK_APORTE            INT4                 null,
   VCH_CATENOMBRE       TEXT                 null,
   VCH_CATEESTADO       CHAR(1)              null,
   constraint PK_CONCEPTOINGRESOEGRESO primary key (PK_CONCEPTO)
);

/*==============================================================*/
/* Index: CONCEPTOINGRESOEGRESO_PK                              */
/*==============================================================*/
create unique index CONCEPTOINGRESOEGRESO_PK on CONCEPTOINGRESOEGRESO (
PK_CONCEPTO
);

/*==============================================================*/
/* Index: RELATIONSHIP_8_FK                                     */
/*==============================================================*/
create  index RELATIONSHIP_8_FK on CONCEPTOINGRESOEGRESO (
PK_APORTE
);

/*==============================================================*/
/* Table: CONFIGURACION                                         */
/*==============================================================*/
create table CONFIGURACION (
   PK_CONFIGURACION     SERIAL               not null,
   VCH_CONFLOGOEMPRESA  TEXT                 null,
   VCH_CONFTITULOSOFTWARE TEXT                 null,
   VCH_CONFDETALLESOFTWARE TEXT                 null,
   VCH_CONFDESCRIPCIONSOFTWARE TEXT                 null,
   INT_CONFFUENTESIZETS INT4                 null,
   INT_CONFFUENTESIZEDETALLESOFT INT4                 null,
   INT_CONFFUENTESIZEDESCRIPSOFT INT4                 null,
   VCH_CONFLENGUAJE     TEXT                 null,
   VCH_CONFTEMASKIN     TEXT                 null,
   VCH_CONFCOLORINGRESOS TEXT                 null,
   VCH_CONFCOLOREGRESOS TEXT                 null,
   VCH_CONFIMAGENPDF    TEXT                 null,
   INT_CONFFUENTESIZETITULOS INT4                 null,
   INT_CONFFUENTESIZETITULOCAMPOS INT4                 null,
   INT_CONFFUENTESIZEDATOS INT4                 null,
   INT_CONFFUENTESIZEBTN INT4                 null,
   DAT_CONFFECHACOPYRIGHT DATE                 null,
   VCH_CONFNOMBREDEVSOFT TEXT                 null,
   VCH_CONFLOGODEVSOFT  TEXT                 null,
   constraint PK_CONFIGURACION primary key (PK_CONFIGURACION)
);

/*==============================================================*/
/* Index: CONFIGURACION_PK                                      */
/*==============================================================*/
create unique index CONFIGURACION_PK on CONFIGURACION (
PK_CONFIGURACION
);

/*==============================================================*/
/* Table: GESTION                                               */
/*==============================================================*/
create table GESTION (
   PK_GESTION           SERIAL               not null,
   VCH_GESTNOMBREPERIOCIDAD TEXT                 null,
   VCH_GESTDESCRIPCION  TEXT                 null,
   VCH_GESTESTADO       CHAR(1)              null,
   constraint PK_GESTION primary key (PK_GESTION)
);

/*==============================================================*/
/* Index: GESTION_PK                                            */
/*==============================================================*/
create unique index GESTION_PK on GESTION (
PK_GESTION
);

/*==============================================================*/
/* Table: MANZANO                                               */
/*==============================================================*/
create table MANZANO (
   PK_MANZANO           SERIAL               not null,
   PK_OTB               INT4                 null,
   VCH_MANZNUMEROMANZANO TEXT                 not null,
   VCH_MANZDESCRIPCION  TEXT                 null,
   VCH_MANZESTADO       CHAR(1)              not null,
   constraint PK_MANZANO primary key (PK_MANZANO)
);

/*==============================================================*/
/* Index: MANZANO_PK                                            */
/*==============================================================*/
create unique index MANZANO_PK on MANZANO (
PK_MANZANO
);

/*==============================================================*/
/* Index: RELATIONSHIP_6_FK                                     */
/*==============================================================*/
create  index RELATIONSHIP_6_FK on MANZANO (
PK_OTB
);

/*==============================================================*/
/* Table: NOMINAASISTENCIA                                      */
/*==============================================================*/
create table NOMINAASISTENCIA (
   PK_NOMINASISTENCIA   SERIAL               not null,
   PK_GESTION           INT4                 null,
   PK_USUARIO           INT4                 null,
   VCH_NOMIFECHA        DATE                 null,
   VCH_NOMINOTADETALLE  TEXT                 null,
   BOL_NOMIASISTENCIAESTADO BOOL                 null,
   constraint PK_NOMINAASISTENCIA primary key (PK_NOMINASISTENCIA)
);

/*==============================================================*/
/* Index: NOMINAASISTENCIA_PK                                   */
/*==============================================================*/
create unique index NOMINAASISTENCIA_PK on NOMINAASISTENCIA (
PK_NOMINASISTENCIA
);

/*==============================================================*/
/* Index: RELATIONSHIP_10_FK                                    */
/*==============================================================*/
create  index RELATIONSHIP_10_FK on NOMINAASISTENCIA (
PK_USUARIO
);

/*==============================================================*/
/* Index: RELATIONSHIP_13_FK                                    */
/*==============================================================*/
create  index RELATIONSHIP_13_FK on NOMINAASISTENCIA (
PK_GESTION
);

/*==============================================================*/
/* Table: OTB                                                   */
/*==============================================================*/
create table OTB (
   PK_OTB               SERIAL               not null,
   VCH_OTBNOMBRE        TEXT                 not null,
   VCH_OTBNOMBREDISTRITO TEXT                 null,
   VCH_OTBNOMBREMUNICIPIO TEXT                 null,
   VCH_OBTESTADO        CHAR(1)              not null,
   constraint PK_OTB primary key (PK_OTB)
);

/*==============================================================*/
/* Index: OTB_PK                                                */
/*==============================================================*/
create unique index OTB_PK on OTB (
PK_OTB
);

/*==============================================================*/
/* Table: PRIVILEGIO                                            */
/*==============================================================*/
create table PRIVILEGIO (
   PK_PRIVILEGIO        SERIAL               not null,
   VCH_PRIVNOMBRE       TEXT                 not null,
   VCH_PRIVPATH         TEXT                 not null,
   BOL_PRIVCLIENTE      BOOL                 null,
   BOL_PRIVADMIN        BOOL                 null,
   VCH_PRIVESTADO       CHAR(1)              not null,
   constraint PK_PRIVILEGIO primary key (PK_PRIVILEGIO)
);

/*==============================================================*/
/* Index: PRIVILEGIO_PK                                         */
/*==============================================================*/
create unique index PRIVILEGIO_PK on PRIVILEGIO (
PK_PRIVILEGIO
);

/*==============================================================*/
/* Table: PROPIEDAD                                             */
/*==============================================================*/
create table PROPIEDAD (
   PK_PROPIEDAD         SERIAL               not null,
   PK_USUARIO           INT4                 null,
   PK_MANZANO           INT4                 null,
   VCH_PROPTIPO         TEXT                 not null,
   VCH_PROPNUMEROLOTE   TEXT                 null,
   VCH_PROPNUMEROCASA   TEXT                 null,
   VCH_PROPESTADO       CHAR(1)              not null,
   constraint PK_PROPIEDAD primary key (PK_PROPIEDAD)
);

/*==============================================================*/
/* Index: PROPIEDAD_PK                                          */
/*==============================================================*/
create unique index PROPIEDAD_PK on PROPIEDAD (
PK_PROPIEDAD
);

/*==============================================================*/
/* Index: RELATIONSHIP_7_FK                                     */
/*==============================================================*/
create  index RELATIONSHIP_7_FK on PROPIEDAD (
PK_MANZANO
);

/*==============================================================*/
/* Index: RELATIONSHIP_11_FK                                    */
/*==============================================================*/
create  index RELATIONSHIP_11_FK on PROPIEDAD (
PK_USUARIO
);

/*==============================================================*/
/* Table: ROL                                                   */
/*==============================================================*/
create table ROL (
   PK_ROL               SERIAL               not null,
   VCH_ROLNOMBRE        TEXT                 not null,
   VCH_ROLESTADO        CHAR(1)              not null,
   constraint PK_ROL primary key (PK_ROL)
);

/*==============================================================*/
/* Index: ROL_PK                                                */
/*==============================================================*/
create unique index ROL_PK on ROL (
PK_ROL
);

/*==============================================================*/
/* Table: USUARIO                                               */
/*==============================================================*/
create table USUARIO (
   PK_USUARIO           SERIAL               not null,
   PK_OTB               INT4                 null,
   PK_ROL               INT4                 null,
   VCH_USUATIPOUSUARIO  TEXT                 not null,
   VCH_USUAUSERNAME     TEXT                 not null,
   VCH_USUANOMBRE       TEXT                 not null,
   VCH_USUAAPP          TEXT                 not null,
   VCH_USUAAPM          TEXT                 null,
   VCH_USUASEXO         TEXT                 not null,
   DAT_USUAFECHANACIMIENTO DATE                 not null,
   VCH_USUACI           TEXT                 not null,
   VCH_USUATELEFONO     TEXT                 null,
   VCH_USUADIRECCION    TEXT                 null,
   VCH_USUAFOTO         TEXT                 null,
   VCH_USUAESTADO       CHAR(1)              not null,
   constraint PK_USUARIO primary key (PK_USUARIO)
);

/*==============================================================*/
/* Index: USUARIO_PK                                            */
/*==============================================================*/
create unique index USUARIO_PK on USUARIO (
PK_USUARIO
);

/*==============================================================*/
/* Index: RELATIONSHIP_3_FK                                     */
/*==============================================================*/
create  index RELATIONSHIP_3_FK on USUARIO (
PK_ROL
);

/*==============================================================*/
/* Index: RELATIONSHIP_5_FK                                     */
/*==============================================================*/
create  index RELATIONSHIP_5_FK on USUARIO (
PK_OTB
);

alter table ANUNCIO
   add constraint FK_ANUNCIO_RELATIONS_USUARIO foreign key (PK_USUARIO)
      references USUARIO (PK_USUARIO)
      on delete restrict on update restrict;

alter table APORTE
   add constraint FK_APORTE_RELATIONS_USUARIO foreign key (PK_USUARIO)
      references USUARIO (PK_USUARIO)
      on delete restrict on update restrict;

alter table APORTE
   add constraint FK_APORTE_RELATIONS_GESTION foreign key (PK_GESTION)
      references GESTION (PK_GESTION)
      on delete restrict on update restrict;

alter table ASIGNADO
   add constraint FK_ASIGNADO_RELATIONS_PRIVILEG foreign key (PK_PRIVILEGIO)
      references PRIVILEGIO (PK_PRIVILEGIO)
      on delete restrict on update restrict;

alter table ASIGNADO
   add constraint FK_ASIGNADO_RELATIONS_ROL foreign key (PK_ROL)
      references ROL (PK_ROL)
      on delete restrict on update restrict;

alter table CONCEPTOINGRESOEGRESO
   add constraint FK_CONCEPTO_RELATIONS_APORTE foreign key (PK_APORTE)
      references APORTE (PK_APORTE)
      on delete restrict on update restrict;

alter table MANZANO
   add constraint FK_MANZANO_RELATIONS_OTB foreign key (PK_OTB)
      references OTB (PK_OTB)
      on delete restrict on update restrict;

alter table NOMINAASISTENCIA
   add constraint FK_NOMINAAS_RELATIONS_USUARIO foreign key (PK_USUARIO)
      references USUARIO (PK_USUARIO)
      on delete restrict on update restrict;

alter table NOMINAASISTENCIA
   add constraint FK_NOMINAAS_RELATIONS_GESTION foreign key (PK_GESTION)
      references GESTION (PK_GESTION)
      on delete restrict on update restrict;

alter table PROPIEDAD
   add constraint FK_PROPIEDA_RELATIONS_USUARIO foreign key (PK_USUARIO)
      references USUARIO (PK_USUARIO)
      on delete restrict on update restrict;

alter table PROPIEDAD
   add constraint FK_PROPIEDA_RELATIONS_MANZANO foreign key (PK_MANZANO)
      references MANZANO (PK_MANZANO)
      on delete restrict on update restrict;

alter table USUARIO
   add constraint FK_USUARIO_RELATIONS_ROL foreign key (PK_ROL)
      references ROL (PK_ROL)
      on delete restrict on update restrict;

alter table USUARIO
   add constraint FK_USUARIO_RELATIONS_OTB foreign key (PK_OTB)
      references OTB (PK_OTB)
      on delete restrict on update restrict;


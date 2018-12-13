drop table d_meio cascade;
drop table d_evento cascade;
drop table d_tempo cascade;
drop table d_junta cascade;




create table d_meio(
    idMeio serial,
    numMeio int not null,
    nomeMeio varchar(80) not null,
    nomeEntidade varchar(80) not null,
    tipo varchar(80),
    constraint pk_d_meio primary key(idMeio),
    UNIQUE(numMeio, nomeEntidade, tipo)
);

create table d_evento(
    idEvento serial,
    numTelefone int not null,
    instanteChamada timestamp not null,
    constraint pk_d_evento primary key(idEvento),
    UNIQUE(numTelefone, instanteChamada)
);

create table d_tempo(
    idTempo serial,
    dia int not null,
    mes int not null,
    ano int not null,
    constraint pk_d_tempo primary key(idTempo),
    UNIQUE(dia, mes, ano)
);



create table d_junta(
    idEvento int not null,
    idMeio int not null,
    dia int not null,
    mes int not null,
    ano int not null,
    constraint pk_d_junta primary key(idEvento, idMeio, dia, mes, ano)
);
drop table camara cascade;
drop table video cascade;
drop table segmentoVideo cascade;
drop table localidade cascade;
drop table vigia cascade;
drop table eventoEmergencia cascade;
drop table processoSocorro cascade;
drop table entidadeMeio cascade;
drop table meio cascade;
drop table meioCombate cascade;
drop table meioApoio cascade;
drop table meioSocorro cascade;
drop table transporta cascade;
drop table acciona cascade;
drop table alocado cascade;
drop table coordenador cascade;
drop table audita cascade;
drop table solicita cascade;

----------------------------------------
-- Table Creation
----------------------------------------

-- Named constraints are global to the database.
-- Therefore the following use the following naming rules:
--   1. pk_table for names of primary key constraints
--   2. fk_table_another for names of foreign key constraints

create table camara(
    numCamara int not null unique,
    constraint pk_numCamara primary key(numCamara)
);

create table video(
    dataHoraInicio timestamp not null,
    dataHoraFim timestamp not null,
    numCamara int not null,
    constraint pk_video primary key(dataHoraInicio, numCamara),
    constraint fk_video_camara foreign key(numCamara) references camara(numCamara)
);

create table segmentoVideo(
    numSegmento int not null,
    duracao interval not null, ----
    dataHoraInicio timestamp not null,
    numCamara int not null,
    constraint pk_segmentoVideo primary key(numSegmento, dataHoraInicio, numCamara),
    constraint fk_segmentoVideo_video foreign key(dataHoraInicio, numCamara) references video(dataHoraInicio, numCamara)
);

create table localidade(
    moradaLocal varchar(80) not null,
    constraint pk_localidade primary key(moradaLocal)
);

create table vigia(
    moradaLocal varchar(80) not null,
    numCamara int not null,
    constraint pk_vigia primary key(moradaLocal, numCamara),
    constraint fk_vigia_localidade foreign key(moradaLocal) references localidade(moradaLocal) on delete cascade,
    constraint fk_vigia_camara foreign key(numCamara) references camara(numCamara) on delete cascade
);

create table processoSocorro(
    numProcessoSocorro int not null unique,
    constraint pk_processoSocorro primary key(numProcessoSocorro)
);

create table entidadeMeio(
    nomeEntidade varchar(80) not null unique,
    constraint pk_entidadeMeio primary key(nomeEntidade)
);

create table eventoEmergencia(
    numTelefone int not null,
    instanteChamada timestamp not null,
    nomePessoa varchar(80) not null,
    moradaLocal varchar(80) not null,
    numProcessoSocorro int, ---- diz no enunciado que pode ser null
    constraint pk_eventoEmergencia primary key(numTelefone, instanteChamada),
    constraint fk_eventoEmergencia_localidade foreign key(moradaLocal) references localidade(moradaLocal) on delete cascade,
    constraint fk_eventoEmergencia_processoSocorro foreign key(numProcessoSocorro) references processoSocorro(numProcessoSocorro) on delete cascade,
    UNIQUE(numTelefone, nomePessoa)
);

create table meio(
    numMeio int not null,
    nomeMeio varchar(80) not null,
    nomeEntidade varchar(80) not null,
    constraint pk_meio primary key(numMeio, nomeEntidade),
    constraint fk_meio_entidadeMeio foreign key(nomeEntidade) references entidadeMeio(nomeEntidade) on delete cascade
);

create table meioCombate(
    numMeio int not null,
    nomeEntidade varchar(80) not null,
    constraint pk_meioCombate primary key(numMeio, nomeEntidade),
    constraint fk_meioCombate_meio foreign key(numMeio, nomeEntidade) references meio(numMeio, nomeEntidade) on delete cascade
);

create table meioApoio(
    numMeio int not null,
    nomeEntidade varchar(80) not null,
    constraint pk_meioApoio primary key(numMeio, nomeEntidade),
    constraint fk_meioApoio_meio foreign key(numMeio, nomeEntidade) references meio(numMeio, nomeEntidade) on delete cascade
);

create table meioSocorro(
    numMeio int not null,
    nomeEntidade varchar(80) not null,
    constraint pk_meioSocorro primary key(numMeio, nomeEntidade),
    constraint fk_meioSocorro_meio foreign key(numMeio, nomeEntidade) references meio(numMeio, nomeEntidade) on delete cascade
);

create table transporta(
    numMeio int not null,
    nomeEntidade varchar(80) not null,
    numVitimas int not null default 0, ---- default 0 (fazer default = 0 ???)
    numProcessoSocorro int not null,
    constraint pk_transporta primary key(numMeio, nomeEntidade, numProcessoSocorro),
    constraint fk_transporta_meioSocorro foreign key(numMeio, nomeEntidade) references meioSocorro(numMeio, nomeEntidade) on delete cascade,
    constraint fk_eventoEmergencia_processoSocorro foreign key(numProcessoSocorro) references processoSocorro(numProcessoSocorro) on delete cascade
);

create table alocado(
    numMeio int not null,
    nomeEntidade varchar(80) not null,
    numHoras int not null,
    numProcessoSocorro int not null,
    constraint pk_alocado primary key(numMeio, nomeEntidade, numProcessoSocorro),
    constraint fk_alocado_meioApoio foreign key(numMeio, nomeEntidade) references meioApoio(numMeio, nomeEntidade) on delete cascade,
    constraint fk_alocado_processoSocorro foreign key(numProcessoSocorro) references processoSocorro(numProcessoSocorro) on delete cascade
);

create table acciona(
    numMeio int not null,
    nomeEntidade varchar(80) not null,
    numProcessoSocorro int not null,
    constraint pk_acciona primary key(numMeio, nomeEntidade, numProcessoSocorro),
    constraint fk_acciona_meio foreign key(numMeio, nomeEntidade) references meio(numMeio, nomeEntidade) on delete cascade,
    constraint fk_acciona_processoSocorro foreign key(numProcessoSocorro) references processoSocorro(numProcessoSocorro) on delete cascade
);

create table coordenador(
    idCoordenador int not null unique,
    constraint pk_coordenador primary key(idCoordenador)
);

create table audita(
    idCoordenador int not null,
    numMeio int not null,
    nomeEntidade varchar(80) not null,
    numProcessoSocorro int not null,
    datahoraInicio timestamp not null, ---- restricoes
    datahoraFim timestamp not null,    ---- restricoes
    dataAuditoria timestamp not null,  ---- restricoes
    texto text,
    constraint pk_audita primary key(idCoordenador, numMeio, nomeEntidade, numProcessoSocorro),
    constraint fk_audita_acciona foreign key(numMeio, nomeEntidade, numProcessoSocorro) references acciona(numMeio, nomeEntidade, numProcessoSocorro) on delete cascade,
    constraint fk_audita_coordenador foreign key(idCoordenador) references coordenador(idCoordenador) on delete cascade,
    check (datahoraInicio < datahoraFim),
    check (datahoraFim < dataAuditoria)
);

create table solicita(
    idCoordenador int not null,
    dataHoraInicioVideo timestamp not null,
    numCamara int not null,
    dataHoraInicio timestamp not null, ---- restricoes
    dataHoraFim timestamp not null,    ---- restricoes
    constraint pk_solicita primary key(idCoordenador, dataHoraInicioVideo, numCamara),
    constraint fk_solicita_coordenador foreign key(idCoordenador) references coordenador(idCoordenador) on delete cascade,
    constraint fk_solicita_video foreign key(dataHoraInicioVideo, numCamara) references video(dataHoraInicio, numCamara) on delete cascade,
    check (datahoraInicio < datahoraFim)
);


/* a */
create or replace function update_solicita()
    returns trigger as $$
    begin
        if not exists (
            select moradaLocal
            from audita natural join eventoEmergencia natural join vigia
            where idCoordenador = new.idCoordenador
                and numCamara = new.numCamara
        ) then
            raise exception 'Erro';
        end if;
        return new;
    end;
$$ language plpgsql;

create trigger update_solicita_trigger before insert on solicita
  for each row execute procedure update_solicita();


/* b */
create or replace function update_alocado()
    returns trigger as $$
    begin
        if not exists (
            select numMeio
            from acciona
            where acciona.numMeio = new.numMeio
            and acciona.nomeEntidade = new.nomeEntidade
            and acciona.numProcessoSocorro = new.numProcessoSocorro
        ) then
            raise exception 'Erro';
        end if;
        return new;
    end;
$$ language plpgsql;

create trigger update_alocado_trigger before insert on alocado
  for each row execute procedure update_alocado();

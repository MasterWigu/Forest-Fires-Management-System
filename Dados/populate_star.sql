CREATE OR REPLACE FUNCTION populateTempo()
  RETURNS VOID AS
  $$
  DECLARE
    date DATE;
    duration INTERVAL;
    test varchar(255);
  BEGIN
    duration := '24 HOURS';
    SELECT EXTRACT( year from min(instantechamada)) INTO test FROM eventoemergencia;
    date = '2018-01-01';

     LOOP
     exit when date = '2019-01-01';
     INSERT INTO d_tempo(dia,mes,ano)
     VALUES (EXTRACT(day from date),EXTRACT(month from date),EXTRACT(year from date));
     date:= date + duration;
     end loop;

  END
  $$ LANGUAGE plpgsql;


SELECT populateTempo();


insert into d_evento (numTelefone, instanteChamada) select numTelefone, instanteChamada from eventoEmergencia;


insert into d_meio (numMeio, nomeMeio, nomeEntidade, tipo) select numMeio, nomeMeio, nomeEntidade, 'Combate' from meio natural join meioCombate;

insert into d_meio (numMeio, nomeMeio, nomeEntidade, tipo) select numMeio, nomeMeio, nomeEntidade, 'Apoio' from meio natural join meioApoio;

insert into d_meio (numMeio, nomeMeio, nomeEntidade, tipo) select numMeio, nomeMeio, nomeEntidade, 'Socorro' from meio natural join meioSocorro;


create or replace function insertmeionull()
    returns void as $$
    begin
        if not exists (
            select moradaLocal
            from audita natural join eventoEmergencia natural join vigia
            where idCoordenador = new.idCoordenador
                and numCamara = new.numCamara
        ) then
            raise exception 'Merda1';
        end if;
        return new;
    end;
$$ language plpgsql;

insert into d_meio (numMeio, nomeMeio, nomeEntidade, tipo) select numMeio, nomeMeio, nomeEntidade, null from meio
 where (numMeio, nomeEntidade) not in (
  meioSocorro s 
  full outer join meioApoio a
    on s.numMeio = a.numMeio
    and s.nomeEntidade = a.nomeEntidade
  full outer join meioCombate c
    on a.numMeio = c.numMeio
    and a.nomeEntidade = c.nomeEntidade);

/*
create table temp (
  int numTelefone not null,
  timestamp instanteChamada not null,
  int numMeio not null,
  varchar(80) nomeEntidade not null
  varchar(80) tipo not null);

select numTelefone, instanteChamada, numMeio, nomeEntidade, 'combate' into temp from eventoemergencia natural join acciona;
select numTelefone, instanteChamada, numMeio, nomeEntidade, 'apoio' into temp from eventoemergencia natural join alocado;
select numTelefone, instanteChamada, numMeio, nomeEntidade, 'socorro' into temp from eventoemergencia natural join transporta;


insert into d_junta (idMeio, idEvento, dia, mes, ano) values (select )*/



CREATE OR REPLACE FUNCTION populated_tempo()
  RETURNS VOID AS $$
  DECLARE
    date DATE;
    duration INTERVAL;
  BEGIN
    duration := '24 HOURS';
    date = '2018-01-01';

     LOOP
     exit when date = '2019-01-01';
     INSERT INTO d_tempo(dia,mes,ano)
     VALUES (EXTRACT(day from date),EXTRACT(month from date),EXTRACT(year from date));
     date:= date + duration;
     end loop;
  END
  $$ LANGUAGE plpgsql;


SELECT populated_tempo();


insert into d_evento (numTelefone, instanteChamada) select numTelefone, instanteChamada from eventoEmergencia;

insert into d_meio (numMeio, nomeMeio, nomeEntidade, tipo) select numMeio, nomeMeio, nomeEntidade, 'Combate' from meio natural join meioCombate;
insert into d_meio (numMeio, nomeMeio, nomeEntidade, tipo) select numMeio, nomeMeio, nomeEntidade, 'Apoio' from meio natural join meioApoio;
insert into d_meio (numMeio, nomeMeio, nomeEntidade, tipo) select numMeio, nomeMeio, nomeEntidade, 'Socorro' from meio natural join meioSocorro;

insert into d_meio (numMeio, nomeMeio, nomeEntidade, tipo)
 select numMeio, nomeMeio, nomeEntidade, null 
 from meio where (numMeio, nomeEntidade) not in (
  select * from meioCombate union
  select * from meioSocorro union
  select * from meioApoio);


drop table if exists test cascade;
create table test(
  numTelefone int not null,
  instanteChamada timestamp not null,
  numMeio int not null,
  nomeEntidade varchar(80) not null,
  tipo varchar(80),
  dia int not null,
  mes int not null,
  ano int not null
  );

insert into test(numTelefone, instanteChamada, numMeio, nomeEntidade, tipo, dia, mes, ano)
  select numTelefone, instanteChamada, numMeio, nomeEntidade, 'Combate',
  EXTRACT(day from instanteChamada), EXTRACT(month from instanteChamada), EXTRACT(year from instanteChamada)
  from eventoemergencia natural join acciona natural join meioCombate;


insert into test(numTelefone, instanteChamada, numMeio, nomeEntidade, tipo, dia, mes, ano)
  select numTelefone, instanteChamada, numMeio, nomeEntidade, 'Apoio',
  EXTRACT(day from instanteChamada), EXTRACT(month from instanteChamada), EXTRACT(year from instanteChamada)
  from eventoemergencia natural join alocado;

insert into test(numTelefone, instanteChamada, numMeio, nomeEntidade, tipo, dia, mes, ano)
  select numTelefone, instanteChamada, numMeio, nomeEntidade, 'Socorro',
  EXTRACT(day from instanteChamada), EXTRACT(month from instanteChamada), EXTRACT(year from instanteChamada)
  from eventoemergencia natural join transporta;

insert into test(numTelefone, instanteChamada, numMeio, nomeEntidade, tipo, dia, mes, ano)
  select numTelefone, instanteChamada, numMeio, nomeEntidade, null,
  EXTRACT(day from instanteChamada), EXTRACT(month from instanteChamada), EXTRACT(year from instanteChamada)
  from eventoemergencia natural join transporta
    where (numMeio, nomeEntidade) not in (
      select * from meioCombate union
      select * from meioSocorro union
      select * from meioApoio);


insert into d_junta(idTempo, idEvento, idMeio)
    select idTempo, idEvento, idMeio
    from test natural join d_evento natural join d_tempo natural join d_meio;

drop table if exists test cascade; --para limpar apenas


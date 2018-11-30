/* QUERIES EM SQL - GRUPO 01 */

/* 1. Processo de socorro que envolveu maior numero de meios distintos */
select distinct numProcessoSocorro
from acciona
group by numProcessoSocorro
having count(numProcessoSocorro) >= all (
    select count(numProcessoSocorro)
    from acciona
    group by numProcessoSocorro);

/* 2. Entidade fornecedora de meios que participou em mais processos de
socorro no Verao de 2018 */
select nomeEntidade
from (
    select distinct nomeEntidade, numProcessoSocorro
    from acciona natural join eventoEmergencia
    where instanteChamada >= '2018-06-21 00:00:00'
      and instanteChamada <= '2018-09-22 23:59:59') as R1
group by nomeEntidade
having count(nomeEntidade) >= all (
    select count(nomeEntidade)
    from (
        select distinct nomeEntidade, numProcessoSocorro
        from acciona natural join eventoEmergencia
        where instanteChamada >= '2018-06-21 00:00:00'
          and instanteChamada <= '2018-09-22 23:59:59') as R2
    group by nomeEntidade);

/* 3. Processos de socorro, referentes a eventos de emergencia em 2018 de
Oliveira do Hospital, onde existe pelo menos um acionamento de meios que
nao foi alvo de auditoria */
select distinct R1.numProcessoSocorro
from (
    select numProcessoSocorro, numMeio, nomeEntidade
    from eventoEmergencia natural join acciona
    where moradaLocal = 'Oliveira do Hospital'
        and instanteChamada >= '2018-01-01 00:00:00'
        and instanteChamada <= '2018-12-31 23:59:59'
) as R1 left join (
    select numProcessoSocorro, numMeio, nomeEntidade
    from audita) as R2 
on R1.numProcessoSocorro = R2.numProcessoSocorro 
and R1.numMeio = R2.numMeio 
and R1.nomeEntidade = R2.nomeEntidade
where R2.numProcessoSocorro is null 
and R2.numMeio is null 
and R2.nomeEntidade is null;

/* 4. Numero de segmentos de video com duração superior a 60 segundos, que
foram gravados em camaras de vigilancia de Monchique durante o mes de Agosto
de 2018 */
select count(numSegmento)
from segmentoVideo natural join vigia
where duracao > '60sec'
    and moradaLocal = 'Monchique'
    and dataHoraInicio >= '2018-08-01 00:00:00'
    and dataHoraInicio <= '2018-08-31 23:59:59';

/* 5. Meios de combate que nao foram usados como Meios de Apoio em nenhum
processo de socorro */
select numMeio, nomeEntidade
from meioCombate C
Where not exists (
    select numMeio, nomeEntidade
    from alocado A
    where C.numMeio = A.numMeio
    and C.nomeEntidade = A.nomeEntidade);

/* 6. Entidades que forneceram meios de combate a todos os Processos de
socorro que acionaram meios */
select nomeEntidade
from meioCombate natural join acciona
group by nomeEntidade
having count(distinct numProcessoSocorro) = (
	select count(distinct numProcessoSocorro)
	from acciona);

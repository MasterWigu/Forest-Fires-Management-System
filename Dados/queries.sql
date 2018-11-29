/* QUERIES EM SQL - GRUPO 01 */

/* 1. Processo de socorro que envolveu maior numero de meios distintos */
/* Testada */
select distinct numProcessoSocorro
from acciona
group by numProcessoSocorro
having count(numProcessoSocorro) >= all (
    select count(numProcessoSocorro)
    from acciona
    group by numProcessoSocorro
);

/* 2. Entidade fornecedora de meios que participou em mais processos de
socorro no Verao de 2018 */
/* Testada */
select nomeEntidade
from
(
select distinct nomeEntidade, numProcessoSocorro
from acciona natural join eventoEmergencia
where instanteChamada >= '2018-06-21 00:00:00'
  and instanteChamada <= '2018-09-21 23:59:59'
) as R1
group by nomeEntidade
having count(nomeEntidade) >= all (
    select count(nomeEntidade)
    from
    (
        select distinct nomeEntidade, numProcessoSocorro
        from acciona natural join eventoEmergencia
        where instanteChamada >= '2018-06-21 00:00:00'
            and instanteChamada <= '2018-09-21 23:59:59'
    ) as R2
    group by nomeEntidade
);


/* 3. Processos de socorro, referentes a eventos de emergencia em 2018 de
Oliveira do Hospital, onde existe pelo menos um acionamento de meios que
nao foi alvo de auditoria */
select numProcessoSocorro
from *R1* as R1 natural join *R2* as R2
where countEvento > countAudita

*R1*
select numProcessoSocorro, count(numProcessoSocorro) as countEvento
from eventoEmergencia natural join acciona
where ...
group by numProcessoSocorro

*R2*
select numProcessoSocorro, count(numProcessoSocorro) as countAudita
from audita
group by numProcessoSocorro

/* 3 completo */
select numProcessoSocorro
from
(
    select numProcessoSocorro, count(numProcessoSocorro) as countEvento
    from eventoEmergencia natural join acciona
    where moradaLocal = 'Oliveira do Hospital'
        and instanteChamada >= '2018-01-01 00:00:00'
        and instanteChamada <= '2018-12-31 23:59:59'
    group by numProcessoSocorro
) as R1 natural join 
(
    select numProcessoSocorro, count(numProcessoSocorro) as countAudita
    from audita
    group by numProcessoSocorro
) as R2
where countEvento > countAudita;


/* 4. Numero de segmentos de video com duração superior a 60 segundos, que
foram gravados em camaras de vigilancia de Monchique durante o mes de Agosto
de 2018 */
/* Testada */

select count(numSegmento)
from segmentoVideo natural join vigia
where duracao > '60sec'
    and moradaLocal = 'Monchique'
    and dataHoraInicio >= '2018-08-01 00:00:00'
    and dataHoraInicio <= '2018-08-31 23:59:59';


/* 5. Meios de combate que nao foram usados como Meios de Apoio em nenhum
processo de socorro */
/* Testada */
select numMeio, nomeEntidade
from meioCombate C
Where not exists (
    select numMeio, nomeEntidade
    from alocado A
    where C.numMeio = A.numMeio
    and C.nomeEntidade = A.nomeEntidade
);


/* 6. Entidades que forneceram meios de combate a todos os Processos de
socorro que acionaram meios */
/* Testada */
select nomeEntidade
from meioCombate natural join acciona
group by nomeEntidade
having count(distinct numProcessoSocorro) = (
	select count(distinct numProcessoSocorro)
	from acciona
);



/* rascunhos */
3.
select numProcessoSocorro
from *R1* as R1 natural join *R2* as R2
where countEvento > countAudita

*R1*
select numProcessoSocorro, count(numProcessoSocorro) as countEvento
from eventoEmergencia natural join aciona
where ...
group by numProcessoSocorro

*R2*
select numProcessoSocorro, count(numProcessoSocorro) as countAudita
from audita
group by numProcessoSocorro

5.
select numMeio, nomeEntidade
from meioCombate C
where not exists (
    select numMeio, nomeEntidade
    from alocado A
    where C.numMeio = A.numMeio
    and C.nomeEntidade = A.nomeEntidade
)

select numMeio, nomeEntidade
from meioCombate
where numMeio, nomeEntidade not in ( --- nao sei como fazer not in com dois
    select numMeio, nomeEntidade
    from alocado
)

6.
select
select customer_name
from depositor natural join account
group by customer_name
having count(distinct branch_name) = (
	select count(branch_name)
	from branch);

select nomeEntidade
from meioComabte natural join acciona
group by nomeEntidade
having count(distinct numProcessoSocorro) = (
	select count(numProcessoSocorro)
	from aciona
);


    select *
    from eventoEmergencia natural join acciona
    where moradaLocal = 'Oliveira do Hospital'
        and instanteChamada >= '2018-01-01 00:00:00'
        and instanteChamada <= '2018-12-31 23:59:59'
    group by numProcessoSocorro
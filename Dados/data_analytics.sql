/*Versao com rollup*/
select tipo, ano, mes, count(idMeio)
from d_junta natural join d_meio natural join d_tempo
where idEvento = 15
group by tipo, rollup(ano, mes)
order by tipo, ano, mes;


/*Versao com union*/
select tipo, ano, mes, count(idMeio)
from d_junta natural join d_meio natural join d_tempo
where idEvento = 15
group by tipo, ano, mes
union
select tipo, ano, null, count(idMeio)
from d_junta natural join d_meio natural join d_tempo
where idEvento = 15
group by tipo, ano
union
select tipo, null, null, count(idMeio)
from d_junta natural join d_meio natural join d_tempo
where idEvento = 15
group by tipo
order by tipo, ano, mes;

select tipo, ano, mes, sum(idMeio)
from d_junta, d_meio
where idEvento = 15
group by rollup(tipo, ano, mes);

select tipo, ano, mes, sum(idMeio)
from d_junta, d_meio
where idEvento = 15
group by tipo, ano, mes
union
select tipo, ano, null, sum(idMeio)
from d_junta, d_meio
where idEvento = 15
group by tipo, ano
union
select tipo, null, null, sum(idMeio)
from d_junta, d_meio
where idEvento = 15
group by tipo
union
select null, null, null, sum(idMeio)
from d_junta, d_meio
where idEvento = 15;

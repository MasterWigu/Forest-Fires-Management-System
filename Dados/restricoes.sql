/* restrições de integridade*/

/* a */
create trigger update_solicita_trigger before insert on solicita
  for each row execute procedure update_solicita();

create or replace function update_solicita()
  returns trigger as $$
  begin
    if not exists (
      select moradaLocal
      from audita natural join eventoEmergencia natural join vigia
      where audita.idCoordenador = new.idCoordenador
        and audita.numCamara = new.numCamara
    )
      raise exception "Merda";
    end if;
    return new;
  end;
  $$ language plpgsql;

/* b */
create trigger update_alocado_trigger before insert on alocado
  for each row execute procedure update_alocado();
/*imprimir a dizer que não pode ser alocado; imprimir a dizer que foi alocado */
create or replace function update_alocado()
  returns trigger as $$
  begin
    if not exists (
      select numMeio
      from acciona
      where acciona.numMeio = new.numMeio
        and acciona.nomeEntidade = new.nomeEntidade
        and acciona.numProcessoSocorro = new.numProcessoSocorro
    )
      raise exception "Merda";
    end if;
    return new
  end;
  $$ language plpgsql;

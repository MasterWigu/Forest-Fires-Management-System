import math
import random
import time
from datetime import datetime, date, time, timedelta


#dados

locs = ['Abadia de Bouro', 'Abas da Raposeira', 'Oliveira do Hospital', 'Oliveira do Hospital', 'Oliveira do Hospital', 'Oliveira do Hospital', 'Agra (Amorim)', 'Monchique', 'Monchique', 'Monchique', 'Monchique', 'Monchique', 'Monchique', 'Aguas Ferreas (Povoa de Varzim)', 'Aguias (Brotas)', 'Aires (Setubal)', 'Alcanica', 'Alcorriol', 'Aldeia (Agucadoura)', 'Aldeia (Amorim)', 'Aldeia Grande', 'Alem (Povoa de Varzim)', 'Algueirao', 'Alveijar (Fatima)', 'Amoreira (Fatima)', 'Amoreira Cimeira', 'Amoreira Fundeira', 'Amoreirinha', 'Amorim de Cima', 'Ancos (Montelavar)', 'Antoes', 'Areosa (Agucadoura)', 'Assequins', 'Azedia', 'Azoia (Sesimbra)', 'Bairro de Almodena', 'Balancho', 'Baldoiaa)', 'Bolfiar', 'Borda do Rio', 'Bouca', 'Brunhido', 'Burgada', 'Busano (Cascais)', 'Bustelo (Oliveira de Azemeis)', 'Cabeda', 'Cabreira (Povoa de Varzim)', 'Cacinheira', 'Cadilhe', 'Calvario (Povoa de Varzim)', 'Calves', 'Caminho Largo', 'Carregosa (Povoa de Varzim)', 'Carvoeiro (Pampilhosa da Serra)', 'Casa Velha (Fatima)', 'Casais de Alem', 'Casais Brancos (Atouguia da Baleia)', 'Casais das Comeiras', 'Casal Mouro', 'Casal do Queijo', 'Casal Resoneiro', 'Casal da Rola', 'Casalinho', 'Casalinho (Fatima)', 'Casas Brancas', 'Casas Novas (Sintra)', 'Castanheira (Cos)', 'Castelhanas', 'Castelo Picao', 'Castro de Nossa Senhora da Confianca', 'Caturela', 'Cavadas', 'Cavaditas', 'Caxieira', 'Cova da Iria', 'Cova do Vapor', 'Covilha (Povoa de Varzim)', 'Crasto (Povoa de Varzim)', 'Cruz (Povoa de Varzim)', 'Cruz de Pau', 'Cruz Quebrada', 'Cuteres', 'Eira da Pedra', 'Enxaminhos', 'Espadelos', 'Esperanca (Ourem)', 'Espinhal (Povoa de Varzim)', 'Estanganhola', 'Estrada (Povoa de Varzim)', 'Foitos', 'Fomega', 'Fontainha', 'Fontainhas (Amorim)', 'Foros de Amora', 'Foros da Catrapona', 'Foz da Serta', 'Fraiao (Povoa de Varzim)', 'Frinjo', 'Fujaco', 'Funchalinho', 'Gesta (Freguesia de Oia)', 'Gestrins', 'Giesteira (Fatima)', 'Gozundeira', 'Granho Novo', 'Granja de Alpriate', 'Granja do Marquês', 'Granjeiro (Agucadoura)', 'Lacoes', 'Laundos (Povoa de Varzim)', 'Lomba (Fatima)', 'Lourel', 'Lousadelo', 'Lugar da Foz', 'Lugar da Pinta', 'Luilhas', 'Machuqueiras', 'Malveira da Serra', 'Mamua', 'Mandim', 'Manique de Baixo', 'Maria Vinagre', 'Matas do Lourical', 'Matos da Vila', 'Mau Verde', 'Maxieira', 'Melecas', 'Mem Martins', 'Mercês (Rio de Mouro)', 'Miratejo', 'Mogos', 'Moimento (Fatima)', 'Moita do Boi', 'Moita Redonda', 'Montelo (Fatima)', 'Mourilhe (Povoa de Varzim)', 'Muleneta', 'Ordem (Povoa de Varzim)']

nomes = ["Beatriz", "Maria", "Sofia", "Camila", "Amanda", "Laura", "Bruna", "Lara", "Julia", "Ana", "Carolina", "Ines", "Isabela", "Mariana", "Viviana", "Catarina", "Carlota", "Guilherme", "Gustavo", "Lucas", "Joao", "Henrique", "Miguel", "Bruno", "Eduardo", "Pedro", "Diogo", "Rafaela", "Vitor", "Jorge", "Joaquim", "Alexandra", "Bernardo", "Andre", "Jose", "Carlos", "Madalena", "Elisabete", "Vera", "Tiago", "Rui", "Nelson", "Renato", "Mario", "Ruben", "Luis", "Catia", "Daniel", "Fabio", "Fernando", "Francisco", "Daniela", "Filipa", "Mafalda", "Marco", "Rodrigo", "Francisca", "Aurora", "Goncalo", "Mauro", "Rita", "Carla", "Armando", "Anabela", "Patricia", "Renata", "Sara", "Tatiana", "Cristina", "Hugo", "Vicente", "Afonso", "Martim", "Santiago", "Tomas", "Duarte", "Gabriel", "Salvador", "Dinis", "David", "Simao", "Manuel", "Leonardo", "Vasco", "Ivo", "Sebastiao", "Jaime", "Claudio", "Amelia", "Diana", "Leonor", "Matilde", "Margarida", "Clara", "Alice", "Benedita", "Vitoria", "Constanca", "Carminho", "Helena", "Nicole", "Teresa", "Filipe", "Barbara", "Raquel", "Lia", "Aurea", "Jessica", "Soraia", "Emilia", "Irina", "Adelaide", "Adriana", "Cidalia", "Paulo", "Ricardo", "Samuel", "Antonio", "Xavier", "Sandro", "Raul", "Rodolfo", "Silvia", "Sergio", "William", "Danilo", "Gloria", "Frederico", "Ian", "Alexandre", "Erica", "Debora", "Joana", "Luisa", "Liliana", "Vanessa", "Fernanda", "Benjamim", "Carmo", "Olivia", "Vania", "Edgar", "Ivo", "Nuno", "Graca", "Guiomar", "Artur", "Marisa", "Palmira", "Emanuel"]
apelidos = ["Silva", "Santos", "Ferreira", "Pereira", "Oliveira", "Costa", "Rodrigues", "Martins", "Jesus", "Sousa", "Fernandes", "Goncalves", "Gomes", "Lopes", "Marques", "Alves", "Almeida", "Ribeiro", "Pinto", "Carvalho", "Teixeira", "Moreira", "Correia", "Mendes", "Nunes", "Soares", "Vieira", "Monteiro", "Cardoso", "Rocha", "Raposo", "Neves", "Coelho", "Cruz", "Cunha", "Pires", "Ramos", "Reis", "Simoes", "Antunes", "Matos", "Fonseca", "Machado", "Araujo", "Barbosa", "Tavares", "Lourenco", "Castro", "Figueiredo", "Azevedo", "Frietas", "Magalhaes", "Henriques", "Lima", "Guerreiro", "Batista", "Pinheiro", "Faria", "Miranda", "Barros", "Morais", "Nogueira", "Esteves", "Anjos", "Campos", "Mota", "Andrade", "Brita", "Sa", "Nascimento", "Leite", "Abreu", "Borges", "Melo", "Vaz", "Pinho", "Vicente", "Gaspar", "Assuncao", "Maia", "Moura", "Valente", "Domingues", "Garcia", "Carneiro", "Loureiro", "Neto", "Amaral", "Branco", "Leal", "Pacheco", "Macedo", "Paiva", "Matias", "Amorim", "Torres", "Abelho", "Assis", "Avelar", "Belmonte", "Belo", "Feio", "Caetano", "Caldeira", "Caneira", "Canela", "Carvalhal", "Albano", "Rebelo", "Saramago", "Dias", "Barata", "Viegas", "Silveira", "Chaves", "Felix", "Flores", "Gil", "Guedes", "Aveiro", "Fonte", "Patricio", "Semedo", "Mario", "Guterres", "Horta", "Jordao", "Lage", "Lameiras", "Leao", "Lobo", "Martinho", "Mata", "Mesquita", "Novais", "Onofre", "Osorio", "Reganha", "Barbas", "Peralta", "Pedro", "Peixoto", "Palhoto", "Pimenta", "Pedreira", "Bernardo", "Setubal", "Patrao", "Prada", "Jorge"]





#funcoes auxiliares

def getSegmentos(numCamara, numSegmentos):
	numSegs = 0;
	segs = []
	vids  = []
	while numSegs<numSegmentos:
		start = random.uniform(12, 1)
		if outIntervals(vids, start):
			end = random.uniform(start+0.0050, start) #video pode ter no max aprox 12 horas
			if outIntervals(vids, end) and outIntervals2(start, end, vids): #se este novo video/segmento nao intersecta nenhum dos ja existentes, criamos
				vids.append((start, end, numCamara))
				segs.append((0, end-start, start, numCamara)) #podemos meter o numSegmento a zero em todos porque têm datashoras e numeros de camaras diferentes
				numSegs+=1
	return (segs, vids)


def createIntervalwDate(time0):
	start = random.uniform(12, time0)
	end = random.uniform(time0, 1) #intervalo pode ter no max aprox 4 dias

	date2 = random.uniform(12, 1)
	if start > end:
		return [end, start, date2]


	return [start, end, date2]

def createIntervalwInterval(start, end):
	start2 = random.uniform(end, start)
	end2 = random.uniform(end, start)

	'''temp = start2+0.15#intervalo pode ter no max aprox 4 dias ou ate end (o que for menor)
	if temp > end:
		temp = end
	end2 = random.uniform(temp, start2)'''
	stTemp = createDateTime(start2)
	endTemp = createDateTime(end2)


	if stTemp > endTemp:
		return (end2, start2)


	return (start2, end2)


def outIntervals(vids, time):
	for i in vids:
		if (i[0]<=time and time <= i[1]):
			return False
	return True

def outIntervals2(start, end, vids):
	for i in vids:
		if (i[0]<=start and start <= i[1]):
			return False
		if (i[0]<=end and end <= i[1]):
			return False
		
		if (start <= i[0] and i[0]<= end):
			return False
		if (start <= i[1] and i[1]<= end):
			return False
	return True


def createDateTime(date):
	mes = math.floor(date)

	if mes in (1, 3, 5, 7, 8, 10, 12):
		dia = math.floor(((math.floor((date - math.floor(date))*100)*31)/100)+1)
	elif mes == 2:
		dia = math.floor(((math.floor((date - math.floor(date))*100)*28)/100)+1)
	else:
		dia = math.floor(((math.floor((date - math.floor(date))*100)*30)/100)+1)

	if mes == 0:
		mes = 1
	if dia == 0:
		dia = 1

	date2 = (date*100)%1

	hora = math.floor(((math.floor((date2 - math.floor(date2))*100)*23)/100)+1)

	date2 = (date2*100)%1

	minuto = math.floor(((math.floor((date2 - math.floor(date2))*100)*59)/100)+1)

	date2 = (date2*100)%1

	segundo = math.floor(((math.floor((date2 - math.floor(date2))*100)*59)/100)+1)
	return datetime(2018, mes, dia, hora, minuto, segundo)


def createDateTime2019(date):
	mes = math.floor(date)

	if mes in (1, 3, 5, 7, 8, 10, 12):
		dia = math.floor(((math.floor((date - math.floor(date))*100)*31)/100)+1)
	elif mes == 2:
		dia = math.floor(((math.floor((date - math.floor(date))*100)*28)/100)+1)
	else:
		dia = math.floor(((math.floor((date - math.floor(date))*100)*30)/100)+1)

	if mes == 0:
		mes = 1
	if dia == 0:
		dia = 1

	date2 = (date*100)%1

	hora = math.floor(((math.floor((date2 - math.floor(date2))*100)*23)/100)+1)

	date2 = (date2*100)%1

	minuto = math.floor(((math.floor((date2 - math.floor(date2))*100)*59)/100)+1)

	date2 = (date2*100)%1

	segundo = math.floor(((math.floor((date2 - math.floor(date2))*100)*59)/100)+1)
	return datetime(2019, mes, dia, hora, minuto, segundo)

def parseDateTime(date):
	return str(createDateTime(date))

def parseTime(date):
	date2= createDateTime(date)
	return str(date2.time())


def geraDate():
	return random.uniform(12, 1)

def timedelta(dateStart, dateEnd):
	start = createDateTime(dateStart)
	end = createDateTime(dateEnd)
	return str((end - start).time)

def geraTelefones(numTel):
	telefCont = 0
	numerosTelefone = []
	prefixos = (210000000, 910000000, 930000000, 960000000)
	while telefCont < numTel:
		num = random.randrange(1111111,9999999)
		num += random.choice(prefixos)
		if num not in numerosTelefone:
			numerosTelefone.append(num)
			telefCont += 1
	return numerosTelefone
	



def geraNomes(numNomes):
	numNomesGerados = 1
	paresGerados = [(20,142)]
	nomesGerados = []
	while numNomesGerados < numNomes:
		numNome = random.randrange(0, len(nomes))
		numApelido = random.randrange(0, len(apelidos))
		par = (numNome, numApelido)
		if par not in paresGerados:
			paresGerados.append(par)
			numNomesGerados+=1

	for i in paresGerados:
		nomesGerados.append(str(nomes[i[0]] + " " + apelidos[i[1]]))
	return nomesGerados

def geraParesTelNome(telefones, nomes):
	random.shuffle(telefones)
	random.shuffle(nomes)
	pares = []

	if len(telefones) > len(nomes):
		for i in telefones:
			index = random.randrange(0, len(nomes))
			pares.append((i, nomes[index]))

	if len(nomes) >= len(telefones):
		for i in nomes:
			index = random.randrange(0, len(telefones))
			pares.append((telefones[index], i))

	return pares

def getNumEvento(nums):
	prob = random.random()
	if prob < 0.05:
		return 0 #5% das vezes retorna 0 (null) como numero de processo de socorro

	else:
		return random.choice(nums)


def geraInstantesChamada(numInstantes):
	numGerados = 0
	dates = []
	times = []
	while numGerados < numInstantes:
		newDate = geraDate()
		if newDate not in dates:
			numGerados += 1
			dates.append(newDate)

	return dates


def getMinDate(num, evnt):
	mindate = 13
	for i in evnt:
		if (i[3] == num):
			if instantes[i[1]] < mindate:
				mindate = instantes[i[1]]
	if mindate == 13:
		return 1
	return mindate






fp = open('populate2.sql', 'w', encoding='UTF-8')


#CAMARA
fp.write('')

camaras = []
for i in range(100):
	fp.write('insert into camara values ('+str(i)+');\n')
	camaras.append(i)

fp.write('\n\n')



#SEGMENTOS

contadorSegmentos = 0;
videos = []
segmentos = []
for camara in camaras:
	numVideos = random.randrange(0,5) #max de dez videos/segmentos por camara
	segvideos = getSegmentos(camara, numVideos)
	segmentos+=segvideos[0]
	videos+=segvideos[1]

for i in videos:
	fp.write("insert into video values ('"+parseDateTime(i[0])+"', '" + parseDateTime(i[1]) + "', "+ str(i[2]) +");\n")

fp.write('\n\n')

for i in segmentos:
	fp.write("insert into segmentoVideo values ("+str(i[0])+", '" + parseTime(i[1]) + "', '"+ parseDateTime(i[2]) +"',"+ str(i[3]) +");\n")


#LOCALIDADES

random.shuffle(locs)
fp.write('\n\n')


loc2 = []
for i in locs:
	if i not in loc2:
		loc2.append(i)
		fp.write("insert into localidade values ('"+i+"');\n")



#VIGIA


locsTemp = locs.copy()
random.shuffle(locsTemp)
random.shuffle(camaras)

fp.write('\n\n')

for i in range(len(camaras)):
	fp.write("insert into vigia values ('"+ locsTemp.pop() + "', " + str(camaras[i]) +");\n")


random.shuffle(locsTemp)
random.shuffle(camaras)
for i in range(len(locsTemp)):
	fp.write("insert into vigia values ('"+ locsTemp[i] + "', " + str(camaras[i]) +");\n")


#Limitacao: nunca havera duas camaras a vigiar o mesmo local

#PROCESSO SOCORRO

procCont = 0
numerosProcessos = []

while procCont < 100:
	num = random.randrange(1,999999999)
	if num not in numerosProcessos:
		numerosProcessos.append(num)
		procCont += 1

fp.write('\n\n')

fp.write("insert into processoSocorro values (0);\n")
for i in numerosProcessos:
	fp.write("insert into processoSocorro values ("+ str(i) + ");\n")


#EVENTO EMERGENCIA

telNomes = geraParesTelNome(geraTelefones(200), geraNomes(250)) #250 nomes e 200 telefones (garantimos que ha telefones com 2 pessoas)
instantes = geraInstantesChamada(len(telNomes))
numerosProcessosTemp = numerosProcessos.copy()

numEvents = 0
eventos = []
paresTelNome = []

while (len(numerosProcessosTemp) > 0):
	newEvento = (random.randrange(0, len(telNomes)), random.randrange(0, len(instantes)), random.randrange(len(locs)), getNumEvento(numerosProcessosTemp))

	if (newEvento not in eventos) and (newEvento[0] not in paresTelNome):
		if newEvento[3] != 0:
			numerosProcessosTemp.remove(newEvento[3])
		eventos.append(newEvento)
		paresTelNome.append(newEvento[0])
		numEvents += 1

fp.write('\n\n')

for i in eventos:
	fp.write("insert into eventoEmergencia values ("+ str(telNomes[i[0]][0]) + ", '" + str(parseDateTime(instantes[i[1]])) + "', '" + str(telNomes[i[0]][1]) +"', '" + locs[i[2]] +"', " + str(i[3]) + ");\n")


#ENTIDADE MEIO

entidades = []
for i in range(100):
	entidades.append(str("Entidade "+str(i)))

fp.write('\n\n')

for i in entidades:
	fp.write("insert into entidadeMeio values ('"+ str(i) + "');\n")


#MEIO

nomesMeios = []
paresMeioEntidade = []

for i in range(7):
	nomesMeios.append(str("Meio " + str(i)))

fp.write('\n\n')

for i in entidades:
	numMeios = random.randrange(0, 7) #para cada entidade criamos entre 0 e 5 meios
	for e in range(numMeios):
		paresMeioEntidade.append((str(e), i))
		fp.write("insert into meio values ("+ str(e) + ", '" + nomesMeios[e] + "', '" + i + "');\n")

#Limitacao: verificar se foram criados mais de 100 meios



#DIVISAO DOS MEIOS PELAS TRES AREAS

random.shuffle(paresMeioEntidade)

meiosCombate = paresMeioEntidade[:int(len(paresMeioEntidade)/3)]
meiosSocorro = paresMeioEntidade[int(len(paresMeioEntidade)/3) : int(2 * len(paresMeioEntidade)/3)]
meiosApoio = paresMeioEntidade[int(2 * len(paresMeioEntidade)/3):]

meiosNotCombate = meiosSocorro + meiosApoio
meiosNotSocorro = meiosCombate + meiosApoio
meiosNotApoio = meiosCombate + meiosSocorro

#insercao de meios que tem varias classificacoes
meiosCombate += random.sample(meiosNotCombate, int(len(meiosNotCombate)/10))
meiosSocorro += random.sample(meiosNotSocorro, int(len(meiosNotSocorro)/10))
meiosApoio += random.sample(meiosNotApoio, int(len(meiosNotApoio)/10))


fp.write('\n\n')
for i in meiosCombate:
	fp.write("insert into meioCombate values ("+ str(i[0]) + ", '" + str(i[1]) + "');\n")

fp.write('\n\n')
for i in meiosApoio:
	fp.write("insert into meioApoio values ("+ str(i[0]) + ", '" + str(i[1]) + "');\n")

fp.write('\n\n')
for i in meiosSocorro:
	fp.write("insert into meioSocorro values ("+ str(i[0]) + ", '" + str(i[1]) + "');\n")



#TRANSPORTA

numElem = 0
transp = []

while numElem < 100:
	newMeio = random.choice(meiosSocorro) + (random.choice(numerosProcessos),)
	if newMeio not in transp:
		transp.append(newMeio)
		numElem += 1

fp.write('\n\n')
for i in transp:
	fp.write("insert into transporta values ("+ str(i[0]) + ", '" + str(i[1]) + "', " + str( random.randrange(6)) + ", " + str(i[2]) + ");\n")



#ALOCA

numElem = 0
aloc = []

while numElem < 100:
	newMeio = random.choice(meiosApoio) + (random.choice(numerosProcessos),)
	if newMeio not in aloc:
		aloc.append(newMeio)
		numElem += 1

fp.write('\n\n')
for i in aloc:
	fp.write("insert into alocado values ("+ str(i[0]) + ", '" + str(i[1]) + "', " + str( random.randrange(6)) + ", " + str(i[2]) + ");\n")



#ACCIONA

acc = transp+ aloc
numElem = 200 #porque ja la estao os transportes e os alocados

while numElem < 300:
	newMeio = random.choice(meiosCombate) + (random.choice(numerosProcessos),)
	if newMeio not in acc:
		acc.append(newMeio)
		numElem += 1


fp.write('\n\n')
for i in acc:
	fp.write("insert into acciona values ("+ str(i[0]) + ", '" + str(i[1]) + "', " + str(i[2]) + ");\n")



#para um dado processo so podem ser accionados meios que estejam alocados, a transportar, ou sejam meios de combate ???
#todos os meios alocados ou a transportar, tem de estar accionados tambem ???

#COORDENADOR


fp.write('\n\n')
for i in range(100):
	fp.write("insert into coordenador values ("+ str(i) + ");\n")



#AUDITA

numAudita = 0
audicoes = []

while numAudita < 100:
	tryAcc = random.choice(acc)
	tryCoord = random.randrange(100)
	newAudita = (tryCoord, tryAcc[0], tryAcc[1], tryAcc[2])
	if newAudita not in audicoes:
		audicoes.append(newAudita)
		numAudita += 1


fp.write('\n\n')
for i in audicoes:
	dates = createIntervalwDate(getMinDate(i[3], eventos)) #i[3] e o numero de processoSocorro
	fp.write("insert into audita values ("+ str(i[0]) + ", '" + str(i[1]) + "', '" + str(i[2]) + "', " + str(i[3]) + ", '" + str(parseDateTime(dates[0])) + "', '" + str(parseDateTime(dates[1])) + "', '" + str(createDateTime2019(dates[2])) + "', '" + "ADSDSATEXTO" +  "');\n")





#SOLICITA

#datashoras de pedido ficam dentro do intervalo do video????

numSol = 0
sols = []

while numSol < 100:
	newSol = (random.randrange(100), random.choice(videos)) #video = (start, end, camara)
	if newSol not in sols:
		sols.append(newSol)
		numSol += 1


fp.write('\n\n')
for i in sols:
	times = createIntervalwInterval(i[1][0], i[1][1]) #times = (start, end)
	fp.write("insert into solicita values ("+ str(i[0]) + ", '" + str(parseDateTime(i[1][0])) + "', " + str(i[1][2]) + ", '" + str(parseDateTime(times[0])) + "', '" + str(parseDateTime(times[1])) + "');\n")



/*Indices*/

/*1*/
create index video_idx on video(numCamara) using hash;
create index video_idx on vigia(numCamara, moradaLocal) using hash;

/*2*/
create index evento_idx on vigia(numTelefone, instanteChamada) using b+tree;


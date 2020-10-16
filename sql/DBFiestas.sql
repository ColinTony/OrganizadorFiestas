create database fiestas;
use fiestas;
set foreign_key_checks=0;
create table usuarios
(
	idUsuario int not null auto_increment primary key,
    usuario varchar(100),
    nombre varchar(100),
    apeP varchar(100),
    apeM varchar(100),
    tel varchar(15),
    correo varchar(100),
    pass varchar(255)
);

create table eventos
(
	idEvento int not null auto_increment primary key,
    idUsuario int not null,
    nombre varchar(100),
    tipo varchar(50),
    fecha varchar(20) not null,
    hora varchar(10) not null,
    menu varchar(50) not null,
    foreign key (idUsuario) references usuarios(idUsuario) on delete cascade on update cascade
);

create table mesas(
	idMesa int not null auto_increment primary key,
    idEvento int not null,
    foreign key(idEvento) references eventos(idEvento) on delete cascade
);
create table invitados(
	idInvitado int not null auto_increment primary key,
    idEvento int not null,
    idUsuario int not null,
    numMesa int not null,
    nombre varchar(100),
    apeP varchar(100),
    apeM varchar(100),
    correo varchar(100),
    foreign key(idUsuario) references usuarios(idUsuario) on delete cascade on update cascade,
    foreign key(idEvento) references eventos(idEvento) on delete cascade on update cascade
);
select * from invitados;
# Procedimientos almacenados

# -----------------------------MESAS----------
delimiter **
create procedure nuevaMesa(idEv int,idMen int)
begin
	insert into mesa(idEvento,idMenu) values (idEv,idMen);
end;**
delimiter ;
delimiter **
create procedure eliminarMesa(idEv int,idMes int)
begin
	delete from mesa where mesa.idMesa = idMes and mesa.idEvento = idEv;
end;**
delimiter ;

delimiter **
create procedure verMesasEvento(idEv int,idMes int)
begin
	select * from mesas where mesas.idEvento = idEv and mesas.idMesa = idMes;
end;**
delimiter ;

# CRUD USUARIOS
#Create
delimiter **
create procedure crearUsuario(
	usuarioC varchar(100),
    nombreC varchar(100),
    apePC varchar(100),
    apeMC varchar(100),
    telC varchar(15),
    correoC varchar(100),
    passC varchar(25))
    begin
		insert into usuarios(usuario,nombre,apeP,apeM,tel,correo,pass) values (usuarioC,nombreC,apePC,apeMC,telC,correoC,passC);
    end;**
delimiter ;

delimiter **
#Update 
create procedure modificarUsuario(
	usuarioC varchar(100),
    nombreC varchar(100),
    apePC varchar(100),
    apeMC varchar(100),
    telC varchar(15),
    correoC varchar(100),
    passC varchar(255), idC int)
    begin
		update usuarios set usuario = usuarioC, nombre=nombreC, apeP=apePC, apeM=apeMC, tel=telC, correo=correoC, pass=passC where usuarios.idUsuario = idC;
    end;**
delimiter ;
delimiter **
#Delete
create procedure eliminarUsuario
(
	id int,
    passC varchar(25)
)
begin
	delete from usuarios where usuarios.idUsuarios = id and usuarios.pass = passC;
end;**
delimiter ;
delimiter **
#Login
create procedure login(usuario varchar(100), passC varchar(255))
begin
	select * from usuarios where usuarios.usuario = usuario and usuarios.pass = passC;
end;**
delimiter ;

#Crud eventos

# CREAR
delimiter **
create procedure crearEvento(
	idUsuarioC int,
    tipoC varchar(50),
    nombreC varchar(100),
    fechaC varchar(20),
    horaC varchar(10),
    menuC varchar(50))
begin
	insert into eventos(idUsuario,tipo,nombre,fecha,hora,menu) values (idUsuarioC,tipoC,nombreC,fechaC,horaC,menuC);
end;**
delimiter ;

# MODIFICAR
delimiter **
create procedure modificarEvento(
	idUsuarioC int,
    tipoC varchar(50),
    nombreC varchar(100),
    fechaC varchar(20),
    horaC varchar(10),
    menuC varchar(50),
    id int)
begin
	update eventos set idUsuario = idUsuarioC, tipo = tipoC,nombre = nombreC, fecha = fechaC, hora = horaC,menu=menuC where idEvento = id; 
end;**
delimiter ;

delimiter **
#Consultar Eventos
create procedure consultarEventos(idUsuario int)
begin
	select * from eventos where eventos.idUsuario = idUsuario;
end;**
delimiter ;

#Consultar Evento especifico
delimiter **
create procedure consultarEventoEsp(idUsuario int, idEvento int)
begin
	select * from eventos where eventos.idUsuario=idUsuario and eventos.idEvento = idEvento;
end;**
delimiter ;

# Eliminar Evento
delimiter **
create procedure eliminarEvento(IdEvento int , idUsuario int)
begin
	delete from eventos where eventos.idEvento = idEvento and eventos.idUsuario = idUsuario;
end;**
delimiter ;

#-----------------CRUD Invitados ------------------------
delimiter **
create procedure crearInvitado(
	idEventoC int,
    idUsuarioC int,
    numMesaC int,
    nombreC varchar(100),
    apePC varchar(100),
    apeMC varchar(100),
    correoC varchar(100))
begin
	insert into invitados(idEvento,idUsuario,numMesa,nombre,apeP,apeM,correo) values (idEventoC,idUsuarioC,numMesaC,nombreC,apePC,apeMC,correoC);
end;**
delimiter ;
delimiter **
create procedure modificarInvitado(
	id int,
    numMesaC int,
    nombreC varchar(100),
    apePC varchar(100),
    apeMC varchar(100),
    correoC varchar(100))
begin
	update invitados set invitados.nombre = nombreC,invitados.numMesa = numMesaC,invitados.apeP = apePC,invitados.apeM = apeMC,invitados.correo = correoC where invitados.idInvitado = id;
end;**
delimiter ;
delimiter **
create procedure asignarMesa(idInvitadoC int , idMesaC int)
begin
	update invitados set invitados.idMesa = idMesaC where invitados.idMesa = idMesaC;
end;**
delimiter ;
delimiter **
create procedure verInvitados(idEv int,idUsu int)
begin
	select * from invitados where invitados.idEvento = idEv and invitados.idUsuario = idUsu;
end;**
delimiter ;

delimiter **
create procedure verInvitadosdeMesa(idEv int,idMesaC int)
begin
	select * from invitados where invitados.idEvento = idEv and invitados.idMesa = idMesaC;
end;**
delimiter ;
delimiter **
create procedure eliminarInvitado(idInv int)
begin
	delete from invitados where invitados.idInvitado = idInv;
end;**
delimiter ;
select * from invitados where invitados.idEvento = 1;
/*# Datos de pruebas insertando usuarios ya probados el CRUD usuarios
call crearUsuario("ColinTony","Luis Antonio","Colin","Heredia","5581832383","colincitoheredia@gmail.com","contraseña");
call crearUsuario("admin","Luis Roberto","Gimenez","Morsa","55943246646","mr.c0l1nr00t@gmail.com","admin");
call crearUsuario("admin2","Luis2 Roberto2","Gimenez2","Morsa2","559432466462","mr.c0l1nr00t@gmail.com2","admin2");

#Eventos
call crearEvento(1,"Otra","Cena familiar","2020-04-13","15:00");
call crearEvento(1,"Otra","Cumpleaños amigos","2020-04-15","15:00");
call crearEvento(1,"Otra","Fiestongo de aniversario","2021-04-13","15:00");

call crearEvento(2,"Familiar","Baile y salon","2020-04-13","15:00");
call crearEvento(2,"Familiar","Años de eventos","2020-04-15","15:00");
call crearEvento(2,"Familiar","Peda mortal","2021-04-13","15:00");

call crearEvento(3,"Negocios","Hasta quedarnos ciegos","2020-04-13","15:00");
call crearEvento(3,"Negocios","Borrachos y alcohol","2020-04-15","15:00");

#call eliminarEvento(7,3);
#call consultarEventos(3);

#Invitados
call crearInvitado(1,"Invitado1","Del Usuario","ColinTony","colincitoheredia@gmail.com");
call crearInvitado(1,"Invitado2","Del Usuario","ColinTony","a@gmail.com");
call crearInvitado(1,"Invitado3","Del Usuario","ColinTony","aaa@gmail.com");

call modificarInvitado(1,"Inv1","De","ColinTony","colincitoheredia@gmail.comm");
call modificarInvitado(2,"Inv1","De","ColinTony","aaa@gmail.comm");
call modificarInvitado(3,"Inv1","De","ColinTony","aaaa@gmail.comm");

call crearInvitado(2,"Invitado1","Del Usuario","admin","colincitoherediaaa@gmail.com");
call crearInvitado(2,"Invitado2","Del Usuario","admin","aaaa@gmail.com");
call crearInvitado(2,"Invitado2","Del Usuario","admin","aaaaa@gmail.com");

call modificarInvitado(4,"Inv2","De","admin","colincitoherediaa@gmail.comm");
call modificarInvitado(5,"Inv2","De","admin","aaa@gmail.comm");
call modificarInvitado(6,"Inv2","De","admin","aaaa@gmail.comm");

call crearInvitado(3,"Invitado1","Del Usuario","admin2","colincitoheredia@gmail.com");
call crearInvitado(3,"Invitado2","Del Usuario","admin2","a@gmail.com");
call crearInvitado(3,"Invitado2","Del Usuario","admin2","aaa@gmail.com");

call modificarInvitado(7,"Inv3","De","admin2","colincitoheredia@gmail.comm");
call modificarInvitado(8,"Inv3","De","admin2","aaa@gmail.comm");
call modificarInvitado(9,"Inv3","De","admin2","aaaa@gmail.comm");
call eliminarInvitado(9);
call verInvitados(3); 

#verInvitadosdeMesa(idEv int,idMesaC int)
#asignarMesa(idInvitadoC int , idMesaC int)
select * from usuarios;
*/
#show tables;
#select count(*) as num from invitados where numMesa = 1;
#drop database fiestas;
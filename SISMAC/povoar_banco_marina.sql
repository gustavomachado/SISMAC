use marina;

insert into usuario(nome,login,senha,perfil,ativo)
values
('root','admin','21232f297a57a5a743894a0e4a801fc3','administrador',1),
('gustavo de souza machado','gustavo.machado','21232f297a57a5a743894a0e4a801fc3','administrador',1);

insert into marina.parametros(chave,valor)values
('nome-emitente-recibo','André de Oliveira Ferreira-ME'),
('endereco-emitente-recibo','Av. Aldeota, nº 04 - Tarumã cep:69.041-000'),
('cpf-cnpj-emitente-recibo','07.355.785/0001-64'),
('multa-atraso','2.0'),
('juros-mes','7.8');

insert into marina.formapagamento(descricao) values('Cartao de Crédito'),('Cartão de Débito'),('Boleto'),('Cheque'),('Dinheiro');
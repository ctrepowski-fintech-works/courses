# Notas tomadas del libro Acquiring Card Payments de Ilya Dubinsky

## Capitulo 1

Los pagos con tarjetas nacieron con la idea de tener un medio conveniente, confiable y rastreable de realizar transacciones monetarias, sin necesidad de cargar siempre con una gran cantidad de efectivo (conveniente), pudiéndose verificar la identidad de quien realiza el pago (confiable) y permitiendo detectar la aplicabilidad de impuestos a las transacciones (rastreable).

### Actores de la industria

Los principales actores presentes en un pago con tarjeta son el **_payer_** (pagador) y el **_payee_** (beneficiario). No se hace la distinción entre persona, empresa o gobierno porque cualquiera de estos pueden tomar el papel de los actores mencionados. Al _payer_ normalmente se le conoce como **_card holder_** (tarjeta-teniente, titular de la tarjeta).

Un **_card scheme_** (esquema/sistema de tarjeta) es el conjunto de pagos con tarjetas y las redes relacionadas a ellos, como infraestructura tecnológica, administración de membresía, riesgos y cumplimiento, entre otros. Ejemplos de card schemes: Visa, Mastercard, American Expresss.

Un **issuer** (emisor) es la entidad que emite tarjetas para sus clientes. Además se encarga de mantener las relaciones financieras con los clientes, llevar registro del balance del titular de la tarjeta, analiza riesgos de fraude, etc. También paga las transacciones presentadas por los adquirentes. 

Un **acquirer** (adquirente) es la entidad que provee servicios a los comercios (en general, a los potenciales beneficiarios) y facilita la recepción de pagos con tarjetas. Para ello puede proveer terminales específicas o delegar este trabajo a otras entidades. Los adquirentes son los responsables de procesar las transacciones, presentar las transacciones autorizadas a los emisores, desembolsar los pagos a los beneficiarios, entre otros.

El rol emisor y el rol adquirente puede (y en muchos casos lo es) ser llevado a cabo por una misma entidad financiera.

Un comercio que quiera aceptar pagos con tarjetas debe relacionarse con una entidad adquirente, la cual operará según el sistema de tarjeta al que esté relacionado. Para evitar discrepancias, aparecen en juego los **_Payment Service Providers (PSP)_**, o, los proveedores de servicios de pagos, que proveen una interfaz uniforme para todos los esquemas de tarjeta soportados y administra relaciones y conexiones técnicas con los esquemas y con las instituciones adquirentes.

### Tipos de esquemas

Un esquema de tarjetas puede ser **cerrado** o **abierto**.

En un esquema cerrado, este se encarga de procesar las transacciones y es responsable del registro financiero tanto con los beneficiarios como con los pagadores. Así, el esquema tiene control total sobre los flujos y la competencia es únicamente con otros esquemas. Ejemplos: American Express, Diners Club.

En un esquema abierto, este se encarga de establecer las reglas y delegar los roles emisor y adquirente a otras instituciones. Ejemplos: Visa, Mastercard, UnionPay.

### Proceso general de un pago con tarjeta

Aplica tanto para compras físicas como en línea. La materialización del proceso varía, pero el flujo es el mismo.

1. Identificación de la cuenta de la tarjeta.
2. Verificación de la tarjeta.
3. Verificación de la identidad del pagador.
4. Generación del mensaje de pago y envío hacia la red de pagos.
5. Respuesta por parte de la red y mostrada al pagador.

## Capítulo 2

### Informaciones incluidas en una tarjeta

1. Branding sobre el esquema de tarjeta
2. Número de tarjeta o PAN.
3. Fecha de expiración.
4. Nombre del titular
5. Número de secuencia: Si el titular renueva su tarjeta luego del vencimiento de la misma, puede en algunos casos solicitar que la nueva mantenga el mismo número. La forma de diferenciar es a través de este elemento, que se incrementa con cada renovación.
6. Chip integrado.
7. Branding de la entidad emisora.
8. Nombre del producto: si es tarjeta de crédito, débito o algún otro producto relacionado.

#### PAN

El *Primary Account Number* **PAN** (número de cuenta primario) es el número de la tarjeta que consiste de 13 a 19 dígitos, siendo lo normal 16. Identifica únicamente al titular de la tarjeta y la cuenta con la entidad emisora.

Ante la multiplicad de entidades, se regula con el estándar ISO/IEC 7812.

Se puede dividir en 3 partes:

- Issuing Industry Number (**IIN**) o Bank Industry Number (**BIN**): Son los primeros 6 a 8 dígitos y sirven para identificar el rubro en el que se está operando
    - El primer dígito es el Major Industry Identifier (**MII**)
- Issuing Account Number (**IAN**): son los siguientes, y como máximo, 12 dígitos, que identifican la cuenta dentro de la entidad emisora.
- Check Digit (**CD**): es un dígito para realizar una suma de verificación con el resto de los números.

### Tipos de tarjetas y productos

- **Tarjeta de cargo, o de débito atrasado**: La entidad emisora efectiviza los pagos realizados por el titular, y este queda endeudado por el monto total de las transacciones. Se debe pagar la totalidad de la deuda al final del periodo acordado.

- **Tarjeta de crédito**: Similar a la tarjeta de cargo, pero la deuda "obligatoria" no es por el total, sino por un monto calculado por la entidad emisora. Esto permite mantener la deuda del pagador y permite a las entidades emisoras obtener ganancias de mantener las deudas activas.

- **Tarjeta de débito**: Los pagos se realizan accediendo a la cuenta corriente del pagador, y solo se admiten pagos según el balance de esta cuenta.

- **Tarjeta prepaga**: Similar a la tarjeta de débito pero permite separar las cuentas, ser de usos específicos y distinguir entre las responsabilidades de la entidad emisora.

Además, las tarjetas pueden ser personales o de empresas, en cualquiera de los tipos mencionados.


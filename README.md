# Guía de Sintaxis Básica de Markdown

Esta guía muestra cómo usar la sintaxis básica de Markdown para documentar tu proyecto en GitHub. A continuación, se presentan ejemplos para cada tipo de sintaxis.

# Encabezados

Los encabezados se crean usando el símbolo #. El número de # indica el nivel del encabezado (de 1 a 6).


# Encabezado 1
## Encabezado 2
### Encabezado 3
#### Encabezado 4
##### Encabezado 5
###### Encabezado 6

# Texto en Negrita y Cursiva
Negrita se logra envolviendo el texto en dos asteriscos ** o dos guiones bajos __.
Cursiva se logra envolviendo el texto en un asterisco * o un guion bajo _.

*Texto en negrita*
_Texto en negrita_

Texto en cursiva
Texto en cursiva

*Texto en negrita y cursiva*

# Listas
Listas no ordenadas se crean usando asteriscos *, signos de más +, o guiones -.

* Elemento de lista
* Otro elemento
  * Sub-elemento

+ Elemento de lista
+ Otro elemento

- Elemento de lista
- Otro elemento

Listas ordenadas se crean usando números seguidos de un punto ..

1. Primer elemento
2. Segundo elemento
   1. Sub-elemento
3. Tercer elemento

# Enlaces
Para crear enlaces, utiliza corchetes [] para el texto del enlace y paréntesis () para la URL.

[Texto del enlace](https://www.ejemplo.com)

# Imágenes
Para insertar imágenes, utiliza un signo de exclamación ! seguido de corchetes [] para el texto alternativo y paréntesis () para la URL de la imagen.

![Texto alternativo](https://www.ejemplo.com/imagen.jpg)

# Citas
Para crear citas, utiliza el símbolo de mayor que >.

> Esta es una cita.

# Código
Código en línea se rodea con una sola comilla inversa `.

código en línea

Bloques de código se rodean con tres comillas inversas . Puedes especificar el lenguaje de programación opcionalmente.

python
def saludo(nombre):
    return f"Hola, {nombre}!"


## Separadores

Para crear un separador horizontal, utiliza tres guiones `---`, asteriscos `***`, o guiones bajos `___`.

# Tablas
Las tablas se crean usando guiones - para los encabezados y barras verticales | para separar las columnas.

| Encabezado 1 | Encabezado 2 |
|--------------|--------------|
| Fila 1, Col 1| Fila 1, Col 2|
| Fila 2, Col 1| Fila 2, Col 2|

# Tareas
Las listas de tareas se crean con corchetes [ ] para tareas pendientes y [x] para tareas completas.

- [ ] Tarea pendiente
- [x] Tarea completada

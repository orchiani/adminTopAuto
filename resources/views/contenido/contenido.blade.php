@extends('principal')
@section('contenido')
<template v-if="menu==0">
<main class="main">
<Pedido> </Pedido>
</main>
</template>
<template v-if="menu==1">
<main class="main">
<Producto> </Producto>
</main>
</template>
<template v-if="menu==2">
<main class="main">
<Cliente> </Cliente>
</main>
</template>
<template v-if="menu==3">
<main class="main">
<Categoria></Categoria>
</main>
</template>
<template v-if="menu==4">
<main class="main">
<Fragancia></Fragancia>
</main>
</template>
<template v-if="menu==5">
<main class="main">
<User></User>
</main>
</template>
<template v-if="menu==6">
<main class="main">
<Marca></Marca>
</main>
</template>

@endsection

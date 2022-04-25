<template>
	<div class="bg-white d-flex flex-column align-items-center py-5 px-3 p-sm-5 col-12 col-lg-8 col-xl-7">
		<h4>PROFILIO REDAGAVIMAS</h4>
		<div class="mt-5 mb-3 w-100 d-flex align-items-center gap-3">
			<label for="username" class="form-label w-35 text-end">Prisijungimo vardas</label>
			<input type="text" id="username" class="form-control w-65" disabled>
		</div>
		<div class="mb-3 w-100 d-flex align-items-center gap-3">
			<label for="firstName" class="form-label w-35 text-end">Vardas</label>
			<input type="text" id="firstName" class="form-control w-65">
		</div>
		<div class="mb-3 w-100 d-flex align-items-center gap-3">
			<label for="lastName" class="form-label w-35 text-end">Pavardė</label>
			<input type="text" id="lastName" class="form-control w-65">
		</div>
		<div class="mb-3 w-100 d-flex align-items-center gap-3">
			<label for="email" class="form-label w-35 text-end">El. paštas</label>
			<input type="email" id="email" class="form-control w-65">
		</div>
		<div class="mb-3 w-100 d-flex align-items-center gap-3">
			<label for="password" class="form-label w-35 text-end">Slaptažodis</label>
			<input type="password" id="password" class="form-control w-65">
		</div>
		<div class="mb-5 w-100 d-flex align-items-center gap-3">
			<label for="passwordAgain" class="form-label w-35 text-end">Slaptažodžio pakartojimas</label>
			<input type="password" id="passwordAgain" class="form-control w-65">
		</div>
		<div class="w-100 d-flex justify-content-end gap-3">
			<button class="btn btn-primary w-50 d-flex justify-content-between"><span class="d-flex justify-content-center w-100">Saugoti</span><i class="fa-solid fa-chevron-right mt-1"></i></button>
		</div>
	</div>
</template>
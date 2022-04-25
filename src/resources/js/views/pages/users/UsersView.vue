<template>
	<div class="bg-white d-flex flex-column py-5 px-3 p-sm-5 col-12 col-xl-10 b-shadow">
		<h4 class="text-center">VARTOTOJAI</h4>
		<div class="input-group my-4">
			<span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
			<input type="text" class="form-control bl-none" placeholder="Ieškoti pagal vardą">
		</div>
		<div class="table-responsive">
			<table class="table users-table text-center fs-m">
				<thead>
				<tr>
					<th scope="col">Vardas</th>
					<th scope="col">Pavardė</th>
					<th scope="col">El. paštas</th>
					<th scope="col">Poke skaičius</th>
					<th scope="col"></th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>Rolandas</td>
					<td>adsdasdasdsa</td>
					<td>test@gmail.com</td>
					<td>8</td>
					<td>
						<button class="btn btn-primary btn-poke d-flex justify-content-between w-100"><span
							class="d-flex justify-content-center w-100">Poke</span><i
							class="fa-solid fa-chevron-right mt-1"></i></button>
					</td>
				</tr>
				<tr>
					<td>Rolsdfsdfsandas</td>
					<td>Pranafsditis</td>
					<td>rfsdfsdfsd@gmail.com</td>
					<td>4</td>
					<td>
						<button class="btn btn-primary btn-poke d-flex justify-content-between w-100"><span
							class="d-flex justify-content-center w-100">Poke</span><i
							class="fa-solid fa-chevron-right mt-1"></i></button>
					</td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>
<template>

	<header class="bg-white shadow">
		<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
			<div id="nav" class="flex justify-center items-center">
				<h2 class="flex-1 font-semibold text-xl text-gray-800 leading-tight">
					Employments
				</h2>
			</div>
		</div>
	</header>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 bg-white border-b border-gray-200">

                    <form @submit.prevent="updateEmployment">
                        <!-- First Name -->
                        <div>
                            <label for="firstname" class="block font-medium text-sm text-gray-700">
                                First Name
                            </label>

                            <input v-model="employment.firstname" id="firstname" type="text" name="firstname" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required autofocus>
                        </div>

                        <!-- Last Name -->
                        <div class="mt-4">
                            <label for="lastname" class="block font-medium text-sm text-gray-700">
                                Last Name
                            </label>

                            <input v-model="employment.lastname" id="lastname" type="text" name="lastname" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required autofocus>
                        </div>

                        <!-- Mid Name -->
                        <div class="mt-4">
                            <label for="midname" class="block font-medium text-sm text-gray-700">
                                Middle Name
                            </label>

                            <input v-model="employment.middle_name" id="midname" type="text" name="middle_name" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" autofocus>
                        </div>

                        <!-- Address -->
                        <div class="mt-4">
                            <label for="address" class="block font-medium text-sm text-gray-700">
                                Address
                            </label>

                            <input v-model="employment.address" id="address" type="text" name="address" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required autofocus>
                        </div>

                        <!-- Zip -->
                        <div class="mt-4">
                            <label for="zip" class="block font-medium text-sm text-gray-700">
                                Zip
                            </label>

                            <input v-model="employment.zip" id="zip" type="text" name="zip" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required autofocus>
                        </div>

                        <!-- Country -->
                        <div class="mt-4">
                            <label for="country" class="block font-medium text-sm text-gray-700">
                                Country
                            </label>

                            <select v-model="employment.country_id" @change="onChange($event, 'country')" id="country" class="block w-full mt-1 pl-3 pr-10 py-2 transition duration-100 ease-in-out border rounded shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed" name="country" required autofocus>
                                <option v-for="country in countries" :key="country.id" v-bind:value="country.id">{{ country.name }}</option>
                            </select>
                        </div>

                        <!-- State -->
                        <div class="mt-4">
                            <label for="state" class="block font-medium text-sm text-gray-700">
                                State
                            </label>

                            <select v-model="employment.state_id" @change="onChange($event, 'state')" id="state" class="block w-full mt-1 pl-3 pr-10 py-2 transition duration-100 ease-in-out border rounded shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed" name="state" required autofocus>
                                <option v-for="state in states_per_country" :key="state.id" v-bind:value="state.id">{{ state.name }}</option>
                            </select>
                        </div>

                        <!-- City -->
                        <div class="mt-4">
                            <label for="city" class="block font-medium text-sm text-gray-700">
                                City
                            </label>

                            <select v-model="employment.city_id" id="city" class="block w-full mt-1 pl-3 pr-10 py-2 transition duration-100 ease-in-out border rounded shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed" name="city" required autofocus>
                                <option v-for="city in cities_per_state" :key="city.id" v-bind:value="city.id">{{ city.name }}</option>
                            </select>
                        </div>

                        <!-- Department -->
                        <div class="mt-4">
                            <label for="department" class="block font-medium text-sm text-gray-700">
                                Department
                            </label>

                            <select v-model="employment.department_id" id="department" class="block w-full mt-1 pl-3 pr-10 py-2 transition duration-100 ease-in-out border rounded shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed" name="department" required autofocus>
                                <option v-for="department in departments" :key="department.id" v-bind:value="department.id">{{ department.name }}</option>
                            </select>
                        </div>

                        <!-- Birth Date  -->
                        <div class="mt-4">
                            <label for="birth_date" class="block font-medium text-sm text-gray-700">
                                Birth Date
                            </label>

                            <input v-model="employment.birth_date" id="birth_date" type="date" name="birth_date" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" autofocus>
                        </div>

                        <!-- Date Hired  -->
                        <div class="mt-4">
                            <label for="hire_date" class="block font-medium text-sm text-gray-700">
                                Date Hired
                            </label>

                            <input v-model="employment.date_hired" id="hire_date" type="date" name="date_hired" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" autofocus>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Create</button>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>

</template>

<script>

	export default {
		data() {
			return {
                employment: {},

				countries: [],
                states: [],
                cities: [],
                departments: [],

                states_per_country: [],
                cities_per_state: [],
			}
		},
		created() {
            this.axios
                .get(`http://localhost:8000/api/employments/${this.$route.params.id}`)
                .then((res) => {
                    this.employment = res.data;
                });
			this.axios.get('http://localhost:8000/api/utils/data').then(response => {
				this.countries = response.data.countries;
                this.states = response.data.states;
                this.cities = response.data.cities;
                this.departments = response.data.departments;

                this.states_per_country = this.states.filter(
                    state => state.country_id == this.employment.country_id
                );
                this.cities_per_state = this.cities.filter(
                    city => city.state_id == this.employment.state_id
                );
			})
		},
		methods: {
            updateEmployment() {
                this.axios
                    .patch(`http://localhost:8000/api/employments/${this.$route.params.id}`, this.employment)
                    .then((res) => {
                        this.$router.push({ name: 'List' });
                    });
            },
            onChange(event, type) {
                this.form_data.city_id = null;
                let value = event.target.value;

                if (type == 'country') {
                    this.form_data.state_id = null;

                    this.states_per_country = this.states.filter(
                        state => state.country_id == value
                    );
                } else {
                    this.cities_per_state = this.cities.filter(
                        city => city.state_id == value
                    );
                }
            }
		}
	}

</script>

<style scoped></style>

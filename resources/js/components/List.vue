<template>

	<header class="bg-white shadow">
		<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
			<div class="flex justify-center items-center">
				<h2 class="flex-1 font-semibold text-xl text-gray-800 leading-tight">
					Employments
				</h2>

                <router-link to="/employments/create" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Add Employment
                </router-link>
			</div>
		</div>
	</header>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 bg-white border-b border-gray-200">

                    <div class="input-group">
                        <input v-on:keyup="search" v-model="search_term" type="text" name="search" placeholder="Search" class="block mb-1 w-52 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/>
                    </div>

                    <table class="min-w-full divide-y divide-gray-100 shadow-sm border-gray-200 border">
                        <thead>
                            <tr>
                                <th class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Name</th>
                                <th class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Address</th>
                                <th class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Zip</th>
                                <th class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Country</th>
                                <th class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">State</th>
                                <th class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">City</th>
                                <th class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Department</th>
                                <th class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Birth Date</th>
                                <th class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Date hired</th>
                                <th class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            <tr v-for="employment in employments">
                                <td class="px-3 py-2 whitespace-no-wrap">
                                    <router-link :to="{name: 'Edit', params: { id: employment.id }}" class="underline text-gray-600 hover:text-gray-900">
                                        {{ employment.firstname }} {{ employment.lastname }}
                                    </router-link>
                                </td>
                                <td class="px-3 py-2 whitespace-no-wrap">{{ employment.address }}</td>
                                <td class="px-3 py-2 whitespace-no-wrap">{{ employment.zip }}</td>
                                <td class="px-3 py-2 whitespace-no-wrap">{{ employment.country.name }}</td>
                                <td class="px-3 py-2 whitespace-no-wrap">{{ employment.state.name }}</td>
                                <td class="px-3 py-2 whitespace-no-wrap">{{ employment.city.name }}</td>
                                <td class="px-3 py-2 whitespace-no-wrap">{{ employment.department.name }}</td>
                                <td class="px-3 py-2 whitespace-no-wrap">{{ employment.birth_date }}</td>
                                <td class="px-3 py-2 whitespace-no-wrap">{{ employment.date_hired }}</td>
                                <td class="px-3 py-2 whitespace-no-wrap flex flex-row">
                                    <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" @click="deleteEmployment(employment.id)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
				</div>
			</div>
		</div>
	</div>

</template>

<script>

	export default {
		data() {
			return {
				employments: [],
                search_term: ""
			}
		},
		created() {
			this.axios.get('http://localhost:8000/api/employments/').then(response => {
				this.employments = response.data
			})
		},
		methods: {
			deleteEmployment(id) {
                this.errors = [];
                this.status = null;
				this.axios
                    .delete(`http://localhost:8000/api/employments/${id}`)
                    .then(response => {
                        let i = this.employments.map(data => data.id).indexOf(id)
                        this.employments.splice(i, 1)
                    })
			},
            search(e) {
                if (e.keyCode === 13) {
                    this.axios
                        .get(`http://localhost:8000/api/employments?search=${this.search_term}`)
                        .then(response => {
                            this.employments = response.data
                        })
                }
            }
		}
	}

</script>

<style scoped></style>

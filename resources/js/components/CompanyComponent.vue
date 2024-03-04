<template>
    <div class="">
        <div class="table-responsive">
            <table class="table table-hovered table-bordered ">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>logo</th>
                        <th>url</th>
                        <th>Company Login</th>
                        
                    </tr>
                </thead>
                <tr v-if="companies.data && companies.data.length==0">
                    <td colspan="3">
                        <div class="bg-warning text-center">There no companies</div>
                    </td>
                </tr>
                <tbody>
                    <tr v-for="company in companies.data" :key="company.id">
                        <td>{{company.name}}</td>
                        <td>{{company.email}}</td>
                        <td>
                            <img :src="'/storage/'+company.logo_path" height="100" width="100">
                        </td>
                        <td>{{company.url}}</td>
                        <td><a :href="`http://${company.domain}.localhost/company-login`" class="ml-4 text-sm text-gray-700 underline">Login</a></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row table-responsive">
            <div class="col-md-12">
                <pagination :data="companies" @pagination-change-page="getResults"></pagination>
            </div>
        </div>
    </div>
</template>

<script>
import pagination from 'laravel-vue-pagination';
export default {
    name:'companiesComponent',
    comments:{pagination},
    data(){
        return{
            companies:{}
        }
    },

    created(){
        this.getResults()
    },

    methods:{
        getResults(page) {
            if (typeof page === 'undefined') {
                page = 1;
            }
    
            axios.get('/companies/paginate=true?page=' + page)
                .then(res => {
                    this.companies = res.data.companies;
                });
        },

        
    }
}
</script>
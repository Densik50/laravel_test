<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pocet vhodnych entries: {{this.data['goodEntries']}}; Pocet nevhodnych entries: {{this.data['badEntries']}}</div>

                    <div class="card-body">{{this.data['entries']}}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
data(){
    return {
        data: {},
    }
},
components: {
},
computed: {
},
created() {
    this.fetchTaskOutput();
    
},

methods: {
    fetchTaskOutput(){
        fetch('api/task3')
            .then(res => res.json())
            .then(res => {
                this.data = res;
            })
    }
}
};
</script>

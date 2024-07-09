<template>
    <WebLayout></WebLayout>
    <div class="form">
        <h2>Process Deliver</h2>
        <table class="table">
            <thead>
                <tr class="table-warning">
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Weight</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Company</th>
                    <th scope="col">Sending Address</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="delivers in deliver" :key="delivers.id">
                    <td>{{ delivers.id }}</td>
                    <td>{{ delivers.name }}</td>
                    <td>{{ delivers.type }}</td>
                    <td>{{ delivers.weight }}</td>
                    <td>{{ delivers.phone_number }}</td>
                    <td>{{ delivers.company }}</td>
                    <td>{{ delivers.sending_address }}</td>
                    <td>
                        <button
                            class="bg-emerald-500 hover:bg-emerald-500 text-white font-bold py-2 px-2 border border-emerald-500 rounded"
                            @click="acceptDelivery(deliver.id)">Accept </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import WebLayout from '@/Components/Layouts/WebLayout.vue';

export default {
    components: {
        WebLayout
    },
    name: 'ProcessDeliverView',
    data() {
        return {
            deliver: [
                {
                    id: 1,
                    name: "fruitatu",
                    type: "snacke",
                    weight:"30kg",
                    phone_number:"0976532454",
                    company:"phner now",
                    sending_address:"371 borey solar",
                },
                {
                    id: 2,
                    name: "fren frice",
                    weight:"25kg",
                    type: "snacke",
                    phone_number:"0976532455",
                    company:"phner now",
                    sending_address:"371 borey solar",
                },
                {
                    id: 3,
                    name: "oranges",
                    weight:"18kg",
                    type: "fruit",
                    phone_number:"0976532456",
                    company:"phner now",
                    sending_address:"371 borey solar",
                },
                {
                    id: 4,
                    name: "fish",
                    weight:"20kg",
                    type: "food",
                    phone_number:"0976532459",
                    company:"phner now",
                    sending_address:"371 borey solar",
                },
                {
                    id: 5,
                    name: "rotee",
                    weight:"12kg",
                    type: "snacke",
                    phone_number:"0976532458",
                    company:"phner now",
                    sending_address:"371 borey solar",
                },
                {
                    id: 6,
                    name: "clothes",
                    weight:"10kg",
                    type: "clothes",
                    phone_number:"0976532457",
                    company:"phner now",
                    sending_address:"371 borey solar",
                }
            ]
        }
    }

}

</script>

<style scoped>
.table {
    justify-content: center;
    align-items: center;
    margin: auto;
    margin: 10px;
    margin-left: 250px;
    width: 800px;
}

h2 {
    display: flex;
    margin: auto;
    margin-left: 250px;

}

</style>
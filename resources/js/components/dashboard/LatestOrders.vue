<script setup>
import api from '@/axios'
import { ref, onMounted } from 'vue'
import moment from 'moment'
const orders = ref()

onMounted(() => {
    fetchLatestOrders()
})


const fetchLatestOrders = () => {
    api.get('latest-orders')
    .then(res => {
       orders.value = res.data.data
    })
}
</script>
<template>
    <Card>
        <template #header>
            <h5 class="text-lg font-semibold">Latest Orders</h5>
        </template>
        <template #content>
            <DataTable :value="orders" tableStyle="min-width: 50rem">
                <Column header="Pizza Name">
                    <template #body="slotProps">
                        {{ slotProps.data.order_detail.pizza.pizza_type.name }}
                    </template>
                </Column>
                <Column header="Size">
                     <template #body="slotProps">
                        {{ slotProps.data.order_detail.pizza.size }}
                    </template>
                </Column>
                <Column header="Category">
                     <template #body="slotProps">
                        {{ slotProps.data.order_detail.pizza.pizza_type.category }}
                    </template>
                </Column>
                <Column header="Quantity">
                     <template #body="slotProps">
                        {{ slotProps.data.order_detail.quantity }}
                    </template>
                </Column>
                <Column header="Order Date and Time">
                     <template #body="slotProps">
                        {{ moment(slotProps.data.ordered_at).format("MMM DD, YYYY hh:mm:ss A") }}
                    </template>
                </Column>
            </DataTable>
        </template>
    </Card>
</template>

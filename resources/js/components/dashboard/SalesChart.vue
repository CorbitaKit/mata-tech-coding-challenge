<script setup>
import { ref, computed } from "vue";
import moment from "moment";

const props = defineProps({
  weekly: Object,
  monthly: Object,
  yearly: Object,
});

const periods = ["Weekly", "Monthly"];
const selectedPeriod = ref("Weekly");
const selectedDate = ref(new Date());


const getStartDate = () => {
  if (selectedPeriod.value === "Weekly") return moment(selectedDate.value).startOf("isoWeek");
  return moment(selectedDate.value).startOf("month");
};


const getEndDate = () => {
  if (selectedPeriod.value === "Weekly") return moment(selectedDate.value).endOf("isoWeek");
  return moment(selectedDate.value).endOf("month");
};

const filteredSales = computed(() => {
  const periodKey = selectedPeriod.value.toLowerCase();
  const salesObject = props[periodKey];

  const salesArray = salesObject
    ? Object.entries(salesObject).map(([date, value]) => ({
        ordered_date: date,
        value: parseFloat(value),
      }))
    : [];

  return salesArray.filter((sale) => {
    const saleDate = moment(sale.ordered_date);
    return saleDate.isBetween(getStartDate(), getEndDate(), null, "[]");
  });
});


const groupSalesData = computed(() => {
  const groupedSales = {};

  if (selectedPeriod.value === "Weekly") {
    const weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    weekdays.forEach(day => {
      groupedSales[day] = 0;
    });

    filteredSales.value.forEach((sale) => {
      const dayOfWeek = moment(sale.ordered_date).format("dddd");
      groupedSales[dayOfWeek] += sale.value;
    });

  } else if (selectedPeriod.value === "Monthly") {
    const startOfMonth = moment(selectedDate.value).startOf("month");
  const endOfMonth = moment(selectedDate.value).endOf("month");


  const weeksInMonth = new Set();
  let current = startOfMonth.clone();

  while (current.isSameOrBefore(endOfMonth)) {
    weeksInMonth.add(current.format("GGGG-[W]WW"));
    current.add(1, "week");
  }


  const weekLabels = Array.from(weeksInMonth);
  weekLabels.forEach((weekKey, index) => {
    groupedSales[`Week ${index + 1}`] = 0;
  });

  filteredSales.value.forEach((sale) => {
    const saleWeekKey = moment(sale.ordered_date).format("GGGG-[W]WW");
    const index = weekLabels.indexOf(saleWeekKey);
    if (index !== -1) {
      groupedSales[`Week ${index + 1}`] += sale.value;
    }
  });

  }

  return groupedSales;
});


const chartData = computed(() => {
  return {
    labels: Object.keys(groupSalesData.value),
    datasets: [
      {
        label: "Sales",
        backgroundColor: "#42A5F5",
        borderRadius: 8,
        barThickness: 30,
        data: Object.values(groupSalesData.value),
        hoverBackgroundColor: "#64B5F6",
      },
    ],
  };
});

const chartOptions = ref({
  responsive: true,
  maintainAspectRatio: false,
  layout: {
    padding: {
      top: 10,
      bottom: 10,
      left: 10,
      right: 10,
    },
  },
  plugins: {
    legend: {
      position: "top",
      labels: {
        color: "#555",
        font: {
          size: 14,
          weight: "500",
        },
      },
    },
    tooltip: {
      backgroundColor: "#f5f5f5",
      titleColor: "#333",
      bodyColor: "#333",
      borderColor: "#ccc",
      borderWidth: 1,
    },
  },
  scales: {
    x: {
      ticks: {
        color: "#666",
        font: {
          size: 12,
        },
      },
      grid: {
        display: false,
      },
    },
    y: {
      ticks: {
        color: "#666",
        font: {
          size: 12,
        },
        beginAtZero: true,
      },
      grid: {
        color: "#eee",
        lineWidth: 1,
      },
    },
  },
});


const changeDate = (direction) => {
  if (selectedPeriod.value === "Daily") {
    selectedDate.value = moment(selectedDate.value).add(direction, "days").toDate();
  } else if (selectedPeriod.value === "Weekly") {
    selectedDate.value = moment(selectedDate.value).add(direction, "weeks").toDate();
  } else {
    selectedDate.value = moment(selectedDate.value).add(direction, "months").toDate();
  }
};


const changePeriod = (period) => {
  selectedPeriod.value = period;
};
</script>

<template>
  <div class="col-12 md:col-6 mb-3">
    <Card>
      <template #header>
        <div class="flex justify-between items-center">
          <h5 class="text-lg font-semibold">Sales Analysis</h5>
          <div class="flex items-center">
            <p-button icon="pi pi-chevron-left" class="p-button-outlined p-button-sm mx-2" @click="changeDate(-1)" />

            <Calendar v-model="selectedDate" dateFormat="yy-mm-dd" class="mx-2" />

            <p-button icon="pi pi-chevron-right" class="p-button-outlined p-button-sm mx-2" @click="changeDate(1)" />

            <Dropdown
              v-model="selectedPeriod"
              :options="periods"
              class="ml-2"
              optionLabel=""
              placeholder="Select Period"
              @change="changePeriod(selectedPeriod)"
            />
          </div>
        </div>
      </template>

      <template #content>
       <Chart type="bar" :data="chartData" :options="chartOptions" class="custom-chart" />
      </template>
    </Card>
  </div>
</template>


<style scoped>
.custom-chart {
  width: 100% !important;
  height: 300px !important;
  max-height: 350px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.card {
  border-radius: 12px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  background: #fff;
}

.card-header {
  background: transparent;
  border-bottom: none;
  display: flex;
  justify-content: space-between;
}

.card-title {
  font-size: 18px;
  font-weight: 600;
}

.sales-chart {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 20px;
}

.pagination-controls {
  display: flex;
  align-items: center;
}

.btn-primary {
  background-color: #007bff;
  border: none;
}

.btn-primary:disabled {
  background-color: #d6d6d6;
  cursor: not-allowed;
}
</style>

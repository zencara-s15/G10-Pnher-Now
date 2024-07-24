<template>
  <div class="card flex-row shadow-sm">
    <div class="card-body flex flex-col">
      <div class="d-flex gap-1 mb-2 align-items-center">
        <i class="bi bi-building text-warning me-2"></i>
        <p class="card-text m-0">
          Company: <strong>{{ item.company }}</strong>
        </p>
      </div>
      <div class="d-flex gap-1 mb-2 align-items-center">
        <i class="bi bi-phone text-primary me-2"></i>
        <p class="card-text m-0">
          Receiver Phone: <strong>{{ item.receiver_phone }}</strong>
        </p>
      </div>
      <div class="d-flex gap-1 mb-2 align-items-center">
        <i class="bi bi-geo-alt text-danger me-2"></i>
        <p class="card-text m-0">
          Sending Address: <strong>{{ item.sending_address }}</strong>
        </p>
      </div>
      <div class="d-flex gap-1 mb-2 align-items-center">
        <i class="bi bi-geo text-success me-2"></i>
        <p class="card-text m-0">
          Receiving Address: <strong>{{ item.receiving_address }}</strong>
        </p>
      </div>
      <div class="d-flex gap-1 mb-2 align-items-center">
        <i class="bi bi-box-seam text-primary me-2"></i>
        <p class="card-text m-0">
          Type: <strong>{{ item.type }}</strong>
        </p>
      </div>
      <div class="d-flex gap-1 mb-2 align-items-center">
        <i class="bi bi-cart text-danger me-2"></i>
        <p class="card-text m-0">
          Weight: <strong>{{ item.weight }} Kg</strong>
        </p>
      </div>
      <div class="d-flex gap-1 mb-2 align-items-center">
        <i class="bi bi-currency-exchange text-success me-2"></i>
        <p class="card-text m-0">
          Total Price: <strong>{{ calculateTotalCost(item.weight) }} Real</strong>
        </p>
      </div>
      <div class="d-flex justify-between gap-20px">
        <button class="btn border-primary w-30">
          <i class="bi bi-pencil-square me-2"></i>Edit
        </button>
        <button class="btn border-danger hover:bg-danger w-30" @click="$emit('delete', item.id)">
          <i class="bi bi-trash me-2"></i>Delete
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'BaggageCard',
  props: {
    item: {
      type: Object,
      required: true,
    },
  },
  methods: {
    calculateTotalCost(weight) {
      return weight * 6000;
    },
  },
};
</script>

<style scoped>
.card {
  border: none;
  border-radius: 12px;
  overflow: hidden;
  transition: box-shadow 0.3s ease-in-out, transform 0.3s ease-in-out;
}
.card:hover {
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  transform: scale(1.05);
}
.card-body {
  padding: 20px;
  background-color: white;
}
.card-body .card-title {
  font-size: 1rem;
  font-weight: bold;
}
.card-body .card-text {
  font-size: 0.875rem;
  color: #6c757d;
}
</style>

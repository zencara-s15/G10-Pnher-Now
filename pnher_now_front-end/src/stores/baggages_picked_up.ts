// src/stores/baggagesPickedUp.ts
import { defineStore } from 'pinia';
import axiosInstance from '@/plugins/axios'; // Import your axios instance

interface Baggage {
  id: number;
  post_id: number | null;
  post_title: string | null;
  user_name: string | null;
  user_email: string | null;
  baggage: {
    baggage_id: number;
    type: string;
    weight: number;
    receiver_phone: string;
    sending_address: string;
    company: string;
    receiving_address: string;
    status: string;
  }[];
  status: string;
}

interface State {
  baggages: Baggage[];
  loading: boolean;
  error: string | null;
}

export const useBaggagesPickedUpStore = defineStore('baggagesPickedUp', {
  state: (): State => ({
    baggages: [],
    loading: false,
    error: null,
  }),
  actions: {
    async fetchBaggagesPickedUp() {
      this.loading = true;
      try {
        const response = await axiosInstance.get('/deliverer_pick_up'); // Use axiosInstance here
        this.baggages = response.data.data;
      } catch (error: any) {
        this.error = error.response ? error.response.data.message : error.message;
      } finally {
        this.loading = false;
      }
    },
  },
});

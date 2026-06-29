import { useEffect, useState } from "react";
import axios from "axios";

type Expense = {
  id: number;
  title: string;
  amount: number;
  date: string;
};

function App() {
  const [expenses, setExpenses] = useState<Expense[]>([]);
  const [total, setTotal] = useState(0);

  const TOKEN = " eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE3ODIzODc5NDEsImV4cCI6MTc4MjQ3NDM0MSwicm9sZXMiOlsiUk9MRV9VU0VSIl0sInVzZXJuYW1lIjoib2JhbWFAdGVzdC5jb20ifQ.FjybJ2bb7W2DuJXRhojMF5N24lYNDteaWFTMSr_9TCc6swWQ-4cPurzufcwPLuzHHFDhxxPQKVMzPMX2LB1nqVOKIWK5f4lUbNsIvV7BsMDA9zmDhcO5u2QQGzQDM_zC5vWogPEu4F2tX00wHQxg8jqZWlIpOZ0_o3voPFDtlyaAhCW5iYj2Wor39Np8XS3pMBaLbqx4BGaOQqPqHq9UPE_OmpHHUX0vC9Wpumj4sZLUo4xlkVhrwJd-2bwJbG_1CWpg4z7Ir4WvgJfD225M8lMAZ8eKJjp_H3gImfsOSavTSuaSX3v_kz3neEkGkXesYpLbe88eGo9VERa7LafMnyjgjlsUQ4Btwzi10O7cRATf9x_dUQUZwgyI_NO7cMh8t6KEPxGORgyPLmDKk-Dl_BsWX82AeP1WmCAWJbpD3cdApdgXPGd7Stwboq644xKD_hIFAYOoGWiv0zYyZwPHmeFfgAFrvpLhb-PYRe7ra--oeFjxS54apPfqSjFZejnJu0zluIYsqKEoKl9RSCalz0RGFypc8i1HiHIaA-i162FR-S6B0TP3Jb_22g8bCkm4h_L4Uh6m9RzPZCBxO-5bXJEGvM3mAZXpTF9nAwK4R7OyzrKesU8oRu2KeNjcNibomAahdBxZMT_PyHZP0tP4fkZ_VNuqnNzYYgR3f4hyHz4";

  useEffect(() => {
    axios
      .get("http://127.0.0.1:8000/api/expenses", {
        headers: {
          Authorization: `Bearer ${TOKEN}`,
        },
      })
      .then((res) => {
        const data = res.data.member || [];
        setExpenses(data);

        const sum = data.reduce(
          (acc: number, expense: Expense) => acc + expense.amount,
          0
        );

        setTotal(sum);
      })
      .catch((error) => {
        console.error(error);
      });
  }, []);

  return (
    <div style={{ padding: "20px" }}>
      <h1>💸 Budget App</h1>

      <h2>Total : {total} €</h2>

      {expenses.map((expense) => (
        <div
          key={expense.id}
          style={{
            border: "1px solid #ddd",
            padding: "10px",
            marginBottom: "10px",
            borderRadius: "8px",
          }}
        >
          <h3>{expense.title}</h3>
          <p>Montant : {expense.amount} €</p>
          <p>Date : {expense.date}</p>
        </div>
      ))}
    </div>
  );
}

export default App;
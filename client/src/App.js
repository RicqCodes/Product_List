import { Routes, Route } from "react-router-dom";
import { ToastContainer } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";

import ProductList from "./components/ProductList";
import AddProduct from "./components/AddProduct";
import Layout from "./layout/Layout";

function App() {
  return (
    <>
      <Routes>
        <Route element={<Layout />}>
          <Route path="/" element={<ProductList />} />
          <Route path="/add-product" element={<AddProduct />} />
        </Route>
      </Routes>
      <ToastContainer />
    </>
  );
}

export default App;

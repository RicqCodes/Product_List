import React from "react";
import { Outlet } from "react-router-dom";
import styled from "styled-components";
import Header from "./Header";
import Footer from "./Footer";
import { Container } from "../styles/element.styled";

const Layout = () => {
  return (
    <Container>
      <Header />
      <Main>
        <Outlet />
      </Main>
      <Footer />
    </Container>
  );
};

export default Layout;

const Main = styled.div`
  width: 100%;
  min-height: calc(100vh - 64px - 24px);
`;

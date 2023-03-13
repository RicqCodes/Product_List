import styled from "styled-components";

import { color, device } from "./utils.styled";
import { spin } from "./animation.styled";

export const Container = styled.div`
  width: 100%;
  max-width: ${({ $fullWidth }) => ($fullWidth ? "100%" : "1440px")};
  padding: 12px 24px;
  margin: auto;
`;

//  Divider

export const Divider = styled.span`
  width: 100%;
  height: ${(props) => (props.height ? props.height : "1px")};
  display: block;
  /* background: ${() => color("tertiary", 100)}; */
  background: #000;
`;

// Resizes based on device scrren size, very fluid
export const FluidTitle = styled.h1`
  color: ${() => (color ? color : color())};
  font-size: 4.8vw;
  font-family: "Epilogue", sans-serif;
  font-weight: ${({ $weight }) => ($weight ? $weight : "700")};
  ${() => device.up("sm")} {
    font-size: ${(props) =>
      props.$size
        ? props.$size
        : props.as === "h2"
        ? "24px"
        : props.as === "h3"
        ? "20px"
        : "32px"};
  }
`;

export const Loader = styled.div`
  width: 64px;
  height: 64px;
  border: 5px solid #000;
  border-radius: 50%;
  border-top: 5px solid #fff;
  animation: ${spin} 1s linear infinite;
`;

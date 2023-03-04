import { theme } from "./global/theme";

export const color = (group = "primary", shade = "main") => {
  const { colors } = theme;
  if (group in colors && shade in colors[group]) {
    return colors[group][shade];
  }

  return null;
};

export const blur = (grade) => {};

export const shadow = (grade = "xs") => {
  const { shadow } = theme;
  if (grade in shadow) {
    return shadow[grade];
  }

  return null;
};

export const device = {
  up: (screen = "xs") => {
    const { breakpoints } = theme;
    if (screen in breakpoints) {
      return `@media (min-width: ${breakpoints[screen]}px)`;
    }

    return `@media (min-width: ${screen}px)`;
  },
  down: (screen = "xs") => {
    const { breakpoints } = theme;
    if (screen in breakpoints) {
      return `@media (max-width: ${breakpoints[screen] - 1}px)`;
    }

    return `@media (max-width: ${screen}px)`;
  },
};

import React from 'react';

interface ButtonProps {
    text: string;
    type?: "main" | "secondary";
}

const Button = ({text, type ="main"} : ButtonProps) => {
    
     let styles = "px-3 py-2 bg-accent hover:bg-accentDark";
    if (type === "secondary"){
        styles = "px-3 py-2 hover:text-neutral-400";
    }
    return (
        <div>
            <button className={`rounded-xl m-0 transition duration-300 ease-in-out ${styles}`} >{text}</button>
        </div>
    );
};

export default Button;
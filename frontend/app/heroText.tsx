import React from 'react';

//TODO fix gradiente idk how to do ts
const HeroText = () => {
    return (
        <div className="w-screen h-screen flex flex-col items-center justify-center">
            <h1 className="text-center text-6xl text font-semibold ">Learn any language</h1>
            <h1 className="text-center text-6xl text font-bold p-1 bg-gradient-to-tr from-accent to-accent bg-clip-text text-transparent">Travel wherever you want</h1>
        </div>
    );
};

export default HeroText;

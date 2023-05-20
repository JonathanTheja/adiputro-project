// install express + multer
// code ini sudah ada di codeshare.io/soainf

const express = require("express");
const app = express();
const multer = require("multer");
const fs = require("fs");

const upload = multer({
    dest: "./uploads",
    limits: { fileSize: 1000000 },
    fileFilter: function (req, file, cb) {
        if (file.mimetype != "image/png") {
            return cb(new Error("Wrong file type"), null);
        }
        cb(null, true);
    },
});

// app.use("/assets", express.static("uploads"));
app.use("/assets", express.static("public"));
app.use(express.urlencoded({ extended: true }));

const accounts = [{ username: "tes" }];

app.get("/account/:username", function (req, res) {
    const account = accounts.find(function (a) {
        return a.username == req.params.username;
    });
    if (!account) {
        return res.status(404).send({ msg: "Not found" });
    }
    return res.status(200).send(account);
});

app.post("/account/", function (req, res) {
    const uploadFunc = upload.single("pp");
    uploadFunc(req, res, function (err) {
        if (err) {
            return res.status(400).send({ ...err, msg: "wrong filetype" });
        }

        let account = accounts.find(function (a) {
            return a.username == req.body.username;
        });
        if (account) {
            fs.unlinkSync(`./uploads/${req.file.filename}`);
            return res.status(400).send({ msg: "Username already taken" });
        }
        console.log(req.file);

        const newFilename = `${req.body.username}.png`;
        fs.renameSync(`./uploads/${req.file.filename}`, `./public/profilepic/${newFilename}`);

        account = { username: req.body.username, pp: `/assets/profilepic/${newFilename}` };
        accounts.push(account);
        return res.status(200).send(account);
    });
});

// app.post("/account/", upload.single("pp"), function (req, res) {
//   let account = accounts.find(function (a) {
//     return a.username == req.body.username;
//   });
//   if (account) {
//     fs.unlinkSync(`./uploads/${req.file.filename}`);
//     return res.status(400).send({ msg: "Username already taken" });
//   }
//   console.log(req.file);

//   const newFilename = `./uploads/${req.body.username}.png`;
//   fs.renameSync(`./uploads/${req.file.filename}`, newFilename);

//   account = { username: req.body.username, pp: newFilename };
//   accounts.push(account);
//   return res.status(200).send(account);
// });

app.put("/account/:username", function (req, res) {
    const account = accounts.find(function (a) {
        return a.username == req.params.username;
    });
    if (!account) {
        return res.status(404).send({ msg: "Not found" });
    }
    return res.status(200).send(account);
});

app.delete("/account/:username", function (req, res) {
    let account = accounts.findIndex(function (a) {
        return a.username == req.params.username;
    });
    if (account == -1) {
        return res.status(404).send({ msg: "Not found" });
    }
    account = accounts.splice(account, 1)[0];
    return res.status(200).send(account);
});

const port = 3000;
app.listen(port, function () {
    console.log(`listening on port ${port}...`);
});
